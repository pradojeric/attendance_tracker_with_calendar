<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Carbon\Carbon;
use App\Assignment;
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
        Notification::send($room->students, new EmailNotification($room));
        return back()->with('message', "Email has been sent");
    }

    public function viewCalendar()
    {
        $events = [];

        $assignments = Auth::user()->assignments->sortBy('deadline');
        if($assignments->count()) {
            foreach ($assignments as $key => $value) {
                $start = Carbon::createFromFormat('Y-m-d H:i:s', $value->deadline);
                $end = Carbon::createFromFormat('Y-m-d H:i:s', $value->deadline);

                if(Auth::user()->finishedAssignments->contains($value))
                {
                    $color = '#228B22';
                }
                else
                {
                    if(now() > $end)
                    {
                        $color = '#FF0000';
                    }
                    else{
                        $color = '#3399FF';
                    }
                }
                $events[] = [
                    'title' => "Assign: ".$value->room->name,
                    'start' => $start,
                    'end' => $end,
                    'color' => $color,
                    'display' => 'block',
                    'url' => url("/view/{$value->id}"),
                ];
            }
        }

        return view('rooms.calendar', compact('assignments', 'events'));
    }

    public function viewAssign(Assignment $assignment)
    {
        return view('rooms.view_assign', compact('assignment'));
    }

}
