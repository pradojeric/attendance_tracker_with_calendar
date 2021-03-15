<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function activateAttendance(Request $request, Schedule $schedule)
    {
        // echo $schedule;
        // echo Auth::user()->roomTeacher->map->schedules->flatten()->contains($schedule);
        // return;
        $this->authorize('own-schedule-teacher', $schedule);

        $request->validate([
            'value' => 'required',
        ]);

        $schedule->attendance = $request->value;
        $schedule->save();

        return redirect()->route('rooms.show', $schedule->room);
    }


}
