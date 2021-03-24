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
        $test = collect([1,2,3,4,4,5,5,6,6,7,7,3,4,2,1,3,6,7,4,5,6,4,8,7,8,8,9,7,7,6,5,5,4,3,2,2,1]);

        $sorted = $test->countBy()->all();
        $sortedKeys = array_keys($sorted);
        $sortedValues = array_values($sorted);


        $ranges = [ // the start of each age-range.
            '0-25' => 25,
            '26-50' => 50,
            '51-60' => 60,
            '61-70' => 70,
            '71-80' => 80,
            '81-90' => 90,
            '91-100' => 100,
        ];

        // return $assessment->studentScores();

        $output = collect($ranges)
            ->map(function($range, $key) use ($assessment){
                $rangeLimit = explode('-', $key);
                $count = $assessment->studentScores()->filter(function($score) use ($rangeLimit){
                    return $score >= $rangeLimit[0] && $score <= $rangeLimit[1];
                })->count();
                return $count;
            })->toArray();

        $colors[0] = '#FF0000';
        $colors[1] = '#FF0000';
        $colors[2] = '#FF8000';
        $colors[3] = '#FFFF00';
        $colors[4] = '#66CC00';
        $colors[5] = '#80FF00';
        $colors[6] = '#00FF00';

        //return $output;

        $labels = array_keys($output);
        $data = array_values($output);

        return view('rooms.assessments.show', compact('assessment', 'labels', 'data', 'colors', 'sortedValues', 'sortedKeys'));
    }
}
