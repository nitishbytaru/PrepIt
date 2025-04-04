<?php
namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Task;
use App\Models\Timeslot;
use Carbon\Carbon;           //used to calculate the days between two dates
use Illuminate\Http\Request; // Add this at the top
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    // ------------------------ helper functions ------------------
    private function validateGoalRequest(Request $request)
    {
        return $request->validate([
            'title'                => 'required|string|max:255',
            'start_date'           => 'required|date',
            'end_date'             => 'required|date|after:start_date',
            'priority'             => 'required|in:High,Medium,Low',
            'time_per_week'        => 'required|numeric|min:1',
            'preferred_start_time' => 'nullable|date_format:H:i',
            'preferred_end_time'   => 'nullable|date_format:H:i|after:preferred_start_time',
        ]);
    }

    private function formatPreferredTimes(Request $request)
    {
        return [
            'preferred_start_time' => $request->preferred_start_time ? Carbon::parse($request->preferred_start_time)->format('H:i') : null,
            'preferred_end_time'   => $request->preferred_end_time ? Carbon::parse($request->preferred_end_time)->format('H:i') : null,
        ];
    }

    private function calculateTotalHours($start_date, $end_date, $time_per_week)
    {
        $days          = Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date));
        $weeks         = intdiv($days, 7);
        $remainingDays = $days % 7;

        return (int) (($weeks * $time_per_week) + ($remainingDays * ($time_per_week / 7)));
    }
    // ------------------------ end helper functions ------------------

    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())->get()->map(function ($goal) {
            $days          = Carbon::parse($goal->start_date)->diffInDays(Carbon::parse($goal->end_date));
            $weeks         = intdiv($days, 7); // Get full weeks
            $remainingDays = $days % 7;        // Get remaining days

            $goal->duration = "{$weeks} weeks" . ($remainingDays > 0 ? " + {$remainingDays} days" : "");
            return $goal;
        });

        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        // Format time
        $formattedTimes = $this->formatPreferredTimes($request);
        $request->merge($formattedTimes);

        // Validate input
        $this->validateGoalRequest($request);

        // Calculate total hours
        $total_hours = $this->calculateTotalHours($request->start_date, $request->end_date, $request->time_per_week);
        // Create a new goal
        $goal = Goal::create([
            'user_id'              => Auth::id(),
            'title'                => $request->title,
            'start_date'           => $request->start_date,
            'end_date'             => $request->end_date,
            'priority'             => $request->priority,
            'time_per_week'        => $request->time_per_week,
            'preferred_start_time' => $request->preferred_start_time,
            'preferred_end_time'   => $request->preferred_end_time,
            'total_hours'          => $total_hours,
        ]);

        return redirect()->route('goals.index')->with('success', 'Goal created successfully!');
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        // Format time
        $formattedTimes = $this->formatPreferredTimes($request);
        $request->merge($formattedTimes);

        // Validate input
        $this->validateGoalRequest($request);

        // Update goal
        $goal->update($request->only([
            'title', 'start_date', 'end_date', 'priority', 'time_per_week', 'preferred_start_time', 'preferred_end_time',
        ]));

        return redirect()->route('goals.index')->with('success', 'Goal updated successfully!');
    }

    public function edit($id)
    {
        $goal = Goal::where('user_id', auth()->id())->where('id', $id)->first();

        if (! $goal) {
            abort(404, 'Goal not found');
        }

        return view('goals.edit', compact('goal'));
    }

    public function destroy($id)
    {
        $goal = Goal::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        $goal->tasks()->delete(); // Delete related tasks first
        $goal->delete();

        return redirect()->route('goals.index')->with('success', 'Goal deleted successfully!');
    }

    /** ---------------------------------------
     * Dynamic Task Generation Algorithm
     * --------------------------------------- */
    private function generateTasks($goal, $startDate = null)
    {
        // Fetch working days and preferred timings from the database
        $timeslots = Timeslot::where('user_id', Auth::id())->first();
        if (! $timeslots) {
            return;
        }

        $workingDays         = json_decode($timeslots->working_days, true);
        $preferredStartTimes = json_decode($timeslots->preferred_start_time, true);
        $preferredEndTimes   = json_decode($timeslots->preferred_end_time, true);
        $sessionDuration     = $timeslots->interval;

        $currentDate = $startDate ? Carbon::parse($startDate) : Carbon::parse($goal->start_date);
        $endDate     = Carbon::parse($goal->end_date);

        $taskCount = 1; // This can be removed check for it again

        // Ensure only 30 days of tasks are generated at a time
        $taskEndDate = $currentDate->copy()->addDays(30);
        if ($taskEndDate->gt($endDate)) {
            $taskEndDate = $endDate;
        }

        while ($currentDate->lte($taskEndDate)) {
            $dayName = $currentDate->format('l');

            if (in_array($dayName, $workingDays)) {
                if (isset($preferredStartTimes[$dayName]) && isset($preferredEndTimes[$dayName])) {
                    $taskStart          = Carbon::parse($preferredStartTimes[$dayName]);
                    $taskEnd            = Carbon::parse($preferredEndTimes[$dayName]);
                    $remainingStudyTime = $goal->time_per_week / count($workingDays);

                    while ($remainingStudyTime > 0 && $taskStart->lt($taskEnd)) {
                        $taskDuration   = min($sessionDuration, $remainingStudyTime * 60);
                        $taskFinishTime = $taskStart->copy()->addMinutes($taskDuration);

                        if ($taskFinishTime->gt($taskEnd)) {
                            break;
                        }

                        // Prevent duplicate task creation
                        if (! Task::where('goal_id', $goal->id)->where('planned_date', $currentDate->toDateString())->exists()) {
                            Task::create([
                                'goal_id'            => $goal->id,
                                'user_id'            => Auth::id(),
                                'title'              => $goal->title . " Task" . $taskCount++,
                                'planned_date'       => $currentDate->toDateString(),
                                'planned_start_time' => $taskStart->format('H:i'),
                                'planned_end_time'   => $taskFinishTime->format('H:i'),
                                'status'             => 'pending',
                            ]);
                        }

                        $taskStart = $taskFinishTime;
                        $remainingStudyTime -= $taskDuration / 60;
                    }
                }
            }
            $currentDate->addDay();
        }
    }

    public function generateMoreTasks($id)
    {
        $goal = Goal::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        // Find the last task's date and generate from there
        $lastTask  = Task::where('goal_id', $goal->id)->orderBy('planned_date', 'desc')->first();
        $startDate = $lastTask ? Carbon::parse($lastTask->planned_date)->addDay() : Carbon::parse($goal->start_date);

        $this->generateTasks($goal, $startDate);

        return redirect()->route('tasks.list', ['goalId' => $goal->id])->with('success', 'Next 30 days of tasks generated.');
    }

}
