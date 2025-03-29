<?php
namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Task;
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

    public function edit($id)
    {
        $task = Task::findOrFail($id); // Fetch the task or throw 404
        return view('tasks.edit', compact('task'));
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
