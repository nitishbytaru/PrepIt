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
        $tasksPaginated = Task::where('goal_id', $goalId)->paginate(9);
        $allTasks       = Task::where('goal_id', $goalId)->get();
        $goal           = Goal::findOrFail($goalId);

        return view('tasks.list', compact('tasksPaginated', 'allTasks', 'goal'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $task->update($request->only([
            'title', 'description', 'planned_date', 'status',
            'planned_start_time', 'planned_end_time',
            'actual_start_time', 'actual_end_time',
        ]));

        return $this->list($task->goal_id);

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
