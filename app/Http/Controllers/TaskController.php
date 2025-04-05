<?php
namespace App\Http\Controllers;

use App\Enums\TaskStatus;
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

    public function finish($taskId)
    {
        $task         = Task::findOrFail($taskId);
        $task->status = TaskStatus::Complete;
        $task->save();

        return redirect()->back()->with('success', 'Task marked as completed!');
    }

    public function postpone($taskId)
    {
        $task         = Task::findOrFail($taskId);
        $task->status = TaskStatus::Postpone;
        $task->save();

        return redirect()->back()->with('success', 'Task Postponed!');
    }

    public function dismiss($taskId)
    {
        $task = Task::findOrFail($taskId);

        // Delete associated postponed records
        PostponedTask::where('original_task_id', $task->id)->delete();

        // Delete the task
        $task->delete();

        return redirect()->back()->with('success', 'Task dismissed and removed successfully!');
    }

}
