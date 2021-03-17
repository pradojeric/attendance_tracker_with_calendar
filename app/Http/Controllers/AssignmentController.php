<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Carbon\Carbon;
use App\Assignment;
use App\Events\AttendanceActivated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class AssignmentController extends Controller
{
    //
    public function emailNotify(Room $room)
    {
        // $user = User::where('email', 'pradoji.627.stud@cdd.edu.ph')->first();

        // $user->notify(new EmailNotification($room));
        //event(new AttendanceActivated($room));
        Notification::send($room->students, new EmailNotification($room));
        return back()->with('message', "Email has been sent");
    }

    public function viewAssign(Assignment $assignment)
    {
        return view('rooms.view_assign', compact('assignment'));
    }

}
