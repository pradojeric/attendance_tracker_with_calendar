<?php

namespace App\Http\Controllers;

use App\Room;
use App\Schedule;
use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    //Teacher

    public function viewAttendance(Attendance $attendance)
    {
        $this->authorize('own-schedule-teacher', $attendance->schedule);

        return view('rooms.attendance', compact('attendance'));
    }

    public function addAttendance(Request $request)
    {
        $schedule = Schedule::find($request->schedule);
        $this->authorize('own-schedule-teacher', $schedule);

        $schedule->attendances()->create([
            'description' => $request->description,
            'attendance_date' => $request->attendance_date,
            'expiry_time' => $request->expiry_time,
        ]);

        return redirect()->route('rooms.show', $schedule->room);
    }

    public function activateAttendance(Request $request, Attendance $attendance)
    {

        $this->authorize('own-schedule-teacher', $attendance->schedule);

        $attendance->attendance = !$attendance->attendance;
        $attendance->save();

        return redirect()->route('rooms.show', $attendance->schedule->room);
    }

    public function deleteAttendance(Attendance $attendance)
    {
        $this->authorize('own-schedule-teacher', $attendance->schedule);

        $attendance->delete();

        return redirect()->route('rooms.show', $attendance->schedule->room);
    }

    public function getAttendances(Request $request, Room $room)
    {
        if(empty($request->date))
            $attendances = Attendance::whereIn('schedule_id', $room->schedules->pluck('id'))->get();
        else{
            $date = date('Y-m-d', strtotime($request->date));

            $attendances = Attendance::whereIn('schedule_id', $room->schedules->pluck('id'))->whereDate('attendance_date', $date)->get();
        }

        $output = "";

        foreach($attendances as $attendance)
        {
            if($attendance->attendance)
                $status = "Deactivate";
            else
                $status = "Activate";

            $output .= '<tr id="'.$attendance->id.'">';
            $output .= '<td>'.$attendance->attendance_date.'</td>';
            $output .= '<td>'.$attendance->schedule->schedule_time.'</td>';
            $output .= '<td>'.$attendance->description.'</td>';
            $output .= '<td>'.$attendance->created_date.'</td>';
            $output .= '<td>'.$attendance->expiry_time.'</td>';
            $output .= '<td class="d-flex justify-content-around">';
            $output .= '<button type="button" class="btn btn-primary btn-sm attendance">'.$status.'</button>';
            $output .= '<button type="button" class="btn btn-secondary btn-sm attendance_view">View</button>';
            $output .= '<button type="button" class="btn btn-danger btn-sm attendance_delete">Delete</button>';
            $output .= '</td>';
            $output .= '</tr>';
        }

        echo $output;
    }

    //Students

    public function studentAttend(Request $request, Attendance $attendance)
    {
        $this->authorize('own-schedule-students', $attendance->schedule);

        Auth::user()->presentTo($attendance);

        return redirect()->route('rooms.show', $attendance->schedule->room);
    }

    public function getStudentAttendances(Room $room)
    {

        $attendances = Attendance::whereIn('schedule_id', $room->schedules->pluck('id'))->where('attendance', 1)->get();

        $output = "";

        foreach($attendances as $attendance)
        {
            $output .= '<tr id="'.$attendance->id.'">';
            $output .= '<td>'.$attendance->attendance_date.'</td>';
            $output .= '<td>'.$attendance->schedule->schedule_time.'</td>';
            $output .= '<td>'.$attendance->description.'</td>';
            $output .= '<td>'.$attendance->created_date.'</td>';
            $output .= '<td>'.$attendance->expiry_time.'</td>';
            $output .= '<td>';
            if(Auth::user()->isPresent($attendance))
                $output .= '<button type="button" class="btn btn-success present" disabled>Present</button>';
            else
                $output .= '<button type="button" class="btn btn-primary present">Present</button>';
            $output .= '</td>';
            $output .= '</tr>';
        }

        echo $output;
    }
}
