<?php
namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Task;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $timeslot = TimeSlot::where('user_id', auth()->id())->first();
        $goals    = Goal::where('user_id', auth()->id())->get();

        if (! $timeslot) {
            return view('dashboard', [
                'totalWorkingHours'      => 0,
                'totalCompensationHours' => 0,
                'goals'                  => [],
                'working_days_per_week'  => 0,
                'timeslot'               => null,
                'pendingTasks'           => collect(), // 👈 Add default here too
            ]);
        }

        $startTimes       = json_decode($timeslot->preferred_start_time, true) ?? [];
        $endTimes         = json_decode($timeslot->preferred_end_time, true) ?? [];
        $workingDays      = json_decode($timeslot->working_days, true) ?? [];
        $compensationDays = json_decode($timeslot->compensation_days, true) ?? [];

        $totalWorkingHours      = 0;
        $totalCompensationHours = 0;

        foreach ($startTimes as $day => $startTime) {
            if (isset($endTimes[$day])) {
                $startHour      = (int) explode(":", $startTime)[0];
                $endHour        = (int) explode(":", $endTimes[$day])[0];
                $availableHours = $endHour - $startHour;

                if (in_array($day, $workingDays)) {
                    $totalWorkingHours += $availableHours;
                }
                if (in_array($day, $compensationDays)) {
                    $totalCompensationHours += $availableHours;
                }
            }
        }

        $working_days_per_week = count($workingDays) > 0 ? count($workingDays) : 1;

        // Process study hours and paginated tasks
        foreach ($goals as $goal) {
            $totalMinutes   = ($goal->time_per_week / $working_days_per_week) * 60;
            $roundedMinutes = round($totalMinutes / 30) * 30;

            $goal->study_hours   = floor($roundedMinutes / 60);
            $goal->study_minutes = $roundedMinutes % 60;

            // Paginate tasks per goal
            $goal->paginated_tasks = $goal->tasks()->paginate(9, ['*'], 'goal_' . $goal->id . '_page');
        }

        // 👇 Show only pending tasks due until yesterday
        $pendingTasks = collect();

        $yesterday = Carbon::yesterday()->toDateString();

        $pendingTasks = Task::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->whereDate('planned_date', '<=', $yesterday)
            ->orderBy('planned_date', 'asc')
            ->get();

        return view('dashboard', compact(
            'totalWorkingHours',
            'totalCompensationHours',
            'goals',
            'working_days_per_week',
            'timeslot',
            'pendingTasks'
        ));
    }
}
