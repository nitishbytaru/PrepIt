<?php
namespace App\Http\Controllers;

use App\Models\Timeslot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeslotController extends Controller
{
    public function index()
    {
        $timeslots = TimeSlot::where('user_id', auth()->id())->get();
        return view('timeslots.index', compact('timeslots'));
    }

    public function create()
    {
        return view('timeslots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'interval'               => 'required|integer|min:1',
            'working_days'           => 'required|array',
            'compensation_days'      => 'nullable|array',
            'preferred_start_time'   => 'required|array',
            'preferred_end_time'     => 'required|array',
            'preferred_start_time.*' => 'required|date_format:H:i',
            'preferred_end_time.*'   => 'required|date_format:H:i',
        ]);

        // Ensure no overlap between Working Days and Compensation Days
        if (! empty(array_intersect($request->working_days, $request->compensation_days ?? []))) {
            return back()->withErrors(['error' => 'A day cannot be both a Working Day and a Compensation Day.']);
        }

        // Ensure start time is before end time for selected days
        foreach ($request->preferred_start_time as $day => $start) {
            if (in_array($day, $request->working_days) || in_array($day, $request->compensation_days ?? [])) {
                $end = $request->preferred_end_time[$day] ?? null;
                if ($start && $end && $start >= $end) {
                    return back()->withErrors(['error' => "Start time for $day must be before end time."]);
                }
            }
        }

        // Store in DB
        Timeslot::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'interval'             => $request->interval,
                'working_days'         => json_encode($request->working_days),
                'compensation_days'    => json_encode($request->compensation_days ?? []),
                'preferred_start_time' => json_encode($request->preferred_start_time),
                'preferred_end_time'   => json_encode($request->preferred_end_time),
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Time slots saved successfully!');
    }

    public function edit()
    {
        $timeslots = TimeSlot::where('user_id', auth()->id())->get();
        $timeslot  = $timeslots->first();
        return view('timeslots.edit', compact('timeslot'));
    }

    public function destroy()
    {
        $timeslots = TimeSlot::where('user_id', auth()->id())->get();
        return view('timeslots.index', compact('timeslots'));
    }
}
