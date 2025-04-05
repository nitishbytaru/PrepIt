<?php
namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\PostponedTask;
use App\Models\Task;
use App\Models\Timeslot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodayController extends Controller
{
    public function index(Request $request)
    {

        $weekOffset     = (int) $request->query('week', 0);
        $selectedDate   = $request->query('date', Carbon::now()->format('Y-m-d'));
        $tasks          = Task::where('user_id', Auth::id())->where('planned_date', $selectedDate)->get();
        $postponedTasks = PostponedTask::where('user_id', Auth::id())->where('new_date', $selectedDate)->get();

        $taskIds = $postponedTasks->pluck('original_task_id')->unique();

        $originalTasks = Task::whereIn('id', $taskIds)->get()->keyBy('id');

        // Map postponed data into tasks
        $postponedTasksWithDetails = $postponedTasks->map(function ($postponed) use ($originalTasks) {
            $task = $originalTasks[$postponed->original_task_id]->replicate();

            $task->id                 = $postponed->original_task_id;
            $task->planned_date       = $postponed->new_date;
            $task->planned_start_time = $postponed->new_start_time;
            $task->planned_end_time   = $postponed->new_end_time;
            $task->is_postponed       = true;
            $task->postponed_reason   = $postponed->reason ?? null;

            return $task;
        });

        $tasks = $tasks->concat($postponedTasksWithDetails);

        return view('todaytasks.index', compact('tasks', 'weekOffset'));
    }

    public function postponeToMakeupDay($taskId)
    {
        $task     = Task::findOrFail($taskId);
        $goal     = $task->goal;
        $timeslot = Timeslot::where('user_id', Auth::id())->first();

        if (! $timeslot) {
            return back()->with('error', 'Timeslot settings not found.');
        }

        $compensationDays = json_decode($timeslot->compensation_days, true);
        $preferredStart   = json_decode($timeslot->preferred_start_time, true);
        $preferredEnd     = json_decode($timeslot->preferred_end_time, true);
        $interval         = $timeslot->interval;

        $date = Carbon::parse($task->planned_date)->addDay(); // Start checking from tomorrow

        while (true) {
            $dayName = $date->format('l');

            if (in_array($dayName, $compensationDays)) {
                if (isset($preferredStart[$dayName]) && isset($preferredEnd[$dayName])) {
                    $start = Carbon::parse($preferredStart[$dayName]);
                    $end   = Carbon::parse($preferredEnd[$dayName]);

                    // Check existing tasks to avoid time clash
                    $existingTasks = Task::where('user_id', Auth::id())
                        ->where('planned_date', $date->toDateString())
                        ->orderBy('planned_start_time')
                        ->get();

                    while ($start->addMinutes(0)->lt($end)) {
                        $endSlot = $start->copy()->addMinutes($interval);

                        // Check for clash
                        $conflict = $existingTasks->first(function ($t) use ($start, $endSlot) {
                            return Carbon::parse($t->planned_start_time)->lt($endSlot) &&
                            Carbon::parse($t->planned_end_time)->gt($start);
                        });

                        if (! $conflict) {
                            // Save postponed task
                            PostponedTask::create([
                                'original_task_id'    => $task->id,
                                'goal_id'             => $task->goal_id,
                                'original_date'       => $task->planned_date,
                                'original_start_time' => $task->planned_start_time,
                                'original_end_time'   => $task->planned_end_time,
                                'new_date'            => $date->toDateString(),
                                'new_start_time'      => $start->format('H:i'),
                                'new_end_time'        => $endSlot->format('H:i'),
                                'reason'              => 'Auto-rescheduled to compensation day',
                                'status'              => TaskStatus::Postpone->value,
                            ]);

                            // Mark original task as postponed
                            $task->status = TaskStatus::Postpone;
                            $task->save();

                            return redirect()->route('todaytasks.index')->with('success', 'Task postponed to a compensation day.');
                        }

                        $start = $endSlot;
                    }
                }
            }

            $date->addDay();
        }
    }

}
