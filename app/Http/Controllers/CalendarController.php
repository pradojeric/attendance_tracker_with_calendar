<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    //
    public function viewCalendar()
    {
        $events = [];

        $assignments = Auth::user()->assignments();
        $assessments = Auth::user()->assessments();

        if($assignments->count()) {
            foreach ($assignments as $key => $value) {
                $start = Carbon::createFromFormat('Y-m-d H:i:s', $value->deadline);
                $end = Carbon::createFromFormat('Y-m-d H:i:s', $value->deadline);

                if(Auth::user()->isAssignmentFinished($value))
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
                    'url' => url("/view/assign/{$value->id}"),
                ];
            }
        }

        if($assessments->count()) {
            foreach ($assessments as $key => $value) {
                $start = Carbon::createFromFormat('Y-m-d H:i:s', $value->deadline);
                $end = Carbon::createFromFormat('Y-m-d H:i:s', $value->deadline);

                if(Auth::user()->isAssessmentFinished($value))
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
                    'title' => "Assess: ".$value->room->name,
                    'start' => $start,
                    'end' => $end,
                    'color' => $color,
                    'display' => 'block',
                    'url' => url("/view/assign/{$value->id}"),
                ];
            }
        }

        return view('rooms.calendar', compact('assignments', 'assessments','events'));
    }

    public function todoList()
    {
        $todos = collect();
        $recents = collect();
        $assignments = Auth::user()->assignments();
        $assessments = Auth::user()->assessments();

        foreach($assignments as $assignment)
        {
            $deadline = Carbon::createFromFormat('Y-m-d H:i:s', $assignment->deadline);
            if(now() > $deadline){
                $recents[] = [
                    'prefix' => 'Assignment',
                    'room' => $assignment->room->name,
                    'title' => $assignment->title,
                    'description' => $assignment->description ?? '',
                    'deadline' => $deadline,
                    'url' => url('/view/assign/'.$assignment->id),
                    'done' => Auth::user()->isAssignmentFinished($assignment),
                ];
            }else{
                $todos[] = [
                    'prefix' => 'Assignment',
                    'room' => $assignment->room->name,
                    'title' => $assignment->title,
                    'description' => $assignment->description ?? '',
                    'deadline' => $deadline,
                    'url' => url('/view/assign/'.$assignment->id),
                    'done' => Auth::user()->isAssignmentFinished($assignment),
                ];
            }
        }

        foreach($assessments as $assessment)
        {
            $deadline = Carbon::createFromFormat('Y-m-d H:i:s', $assessment->deadline);
            if(now() > $deadline){
                $recents[] = [
                    'prefix' => 'Assessment',
                    'room' => $assessment->room->name,
                    'title' => $assessment->title,
                    'description' => $assessment->description ?? '',
                    'deadline' => $deadline,
                    'url' => url('/view/assign/'.$assessment->id),
                    'done' => Auth::user()->isAssessmentFinished($assessment),
                ];
            }else{
                $todos[] = [
                    'prefix' => 'Assessment',
                    'room' => $assignment->room->name,
                    'title' => $assessment->title,
                    'description' => $assessment->description ?? '',
                    'deadline' => $deadline,
                    'url' => url('/view/assessment/'.$assessment->id),
                    'done' => Auth::user()->isAssessmentFinished($assessment),
                ];
            }
        }

        $todos = $todos->sortBy(function($item){
            return $item['deadline'];
        });

        $recents = $recents->sortBy(function($item){
            return $item['deadline'];
        });

        return view('rooms.todos', compact('todos', 'recents'));
    }
}
