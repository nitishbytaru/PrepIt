<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodayController extends Controller
{
    public function index(Request $request)
    {

        $weekOffset   = (int) $request->query('week', 0);
        $selectedDate = $request->query('date', Carbon::now()->format('Y-m-d'));
        $tasks = Task::where('user_id', Auth::id())->where('planned_date', $selectedDate)->get();

        return view('todaytasks.index', compact('tasks', 'weekOffset'));
    }

}
