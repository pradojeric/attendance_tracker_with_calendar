<?php

namespace App\Http\Controllers;

use App\Room;
use App\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    //
    public function viewAssessment(Assessment $assessment)
    {
        return view('rooms.view_assessment', compact('assessment'));
    }

    public function index(Room $room)
    {
        return view('rooms.assessments.index', compact('room'));
    }

    public function show(Assessment $assessment)
    {
        return view('rooms.assessments.show', compact('assessment'));
    }
}
