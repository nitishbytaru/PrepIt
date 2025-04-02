<?php
namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', auth()->id())->get();
        return view('tasks.index', compact('goals'));
    }

    public function list($goalId)
    {
        $tasks = Task::where('goal_id', $goalId)->get();
        $goal  = Goal::where('id', $goalId)->get()->first();
        return view('tasks.list', compact('tasks', 'goal'));
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
