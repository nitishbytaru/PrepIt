<?php
namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\TimeSlot;

class DashboardController extends Controller
{
    public function index()
    {
        $timeslot = TimeSlot::where('user_id', auth()->id())->first();
        $goals    = Goal::where('user_id', auth()->id())->get();

        if (! $timeslot) {
            // Handle case where there is no timeslot
            return view('dashboard', [
                'totalWorkingHours'      => 0,
                'totalCompensationHours' => 0,
                'goals'                  => [],
                'working_days_per_week'  => 0,
                'timeslot'               => null,
            ]);
        }

        // Decode JSON data
        $startTimes       = json_decode($timeslot->preferred_start_time, true) ?? [];
        $endTimes         = json_decode($timeslot->preferred_end_time, true) ?? [];
        $workingDays      = json_decode($timeslot->working_days, true) ?? [];
        $compensationDays = json_decode($timeslot->compensation_days, true) ?? [];

        $totalWorkingHours      = 0;
        $totalCompensationHours = 0;

        foreach ($startTimes as $day => $startTime) {
            if (isset($endTimes[$day])) {
                $startHour      = (int) explode(":", $startTime)[0]; // Extract hour
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

        // Process study hours per day for each goal
        if ($goals->isNotEmpty()) {
            foreach ($goals as $goal) {
                $totalMinutes = ($goal->time_per_week / $working_days_per_week) * 60;

                // Round minutes to nearest 30 min interval
                $roundedMinutes = round($totalMinutes / 30) * 30;

                // Convert back to hours and minutes
                $goal->study_hours   = floor($roundedMinutes / 60);
                $goal->study_minutes = $roundedMinutes % 60;
            }
        }

        return view('dashboard', compact('totalWorkingHours', 'totalCompensationHours', 'goals', 'working_days_per_week', 'timeslot'));
    }

}
