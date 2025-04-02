<?php
namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())->get();
        return view('tasks.index', compact('goals'));
    }

    public function list(Request $request, $goalId)
    {
        // Get the week offset from query parameters (default to 0)
        $weekOffset = (int) $request->query('week', 0);

        // Get the specific selected date or default to today's date
        $selectedDate = $request->query('date', Carbon::now()->format('Y-m-d'));

        // Fetch tasks only for the selected date
        $tasks = Task::where('goal_id', $goalId)
            ->whereDate('planned_date', $selectedDate)
            ->get();

        // Get goal details
        $goal = Goal::findOrFail($goalId);

        return view('tasks.list', compact('tasks', 'goal', 'weekOffset', 'selectedDate'));
    }

    public function edit($id) // function for finding the task which needed to be edited
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $taskId)
    {
        $task  = Task::where('id', $taskId);
        $goals = Goal::where('user_id', auth()->id())->get();

        if (! $task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->update($request->only([
            'title', 'description', 'planned_date', 'status',
            'planned_start_time', 'planned_end_time',
            'actual_start_time', 'actual_end_time',
        ]));

        return view('tasks.index', compact('goals'));
    }

    public function finish()
    {
        echo "marked this task as finished ";
    }

    public function postpone()
    {
        echo "marked this task as postponed ";
    }

    public function dismiss()
    {
        echo "successfully dismissed this task ";
    }
}
