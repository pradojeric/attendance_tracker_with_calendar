<?php

namespace App\Http\Controllers;

use App\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    //
    public function viewAssessment(Assessment $assessment)
    {
        return view('rooms.view_assessment', compact('assessment'));
    }
}
