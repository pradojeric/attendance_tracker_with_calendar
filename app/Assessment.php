<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    //
    protected $guarded = [];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'assessment_student', 'assessment_id', 'student_id')->withPivot('score')->withTimestamps();
    }

    public function studentScores()
    {
        return $this->students->pluck('pivot.score');
    }

    public function getStudentListAttribute()
    {
        return $this->room->students
            ->map(function($student){
                $student->score = $student->finishedAssessments->where('pivot.assessment_id', $this->id)->pluck('pivot.score')->first();
                return $student;
            })
            //->sortByDesc('score')->values();
            ->sortByDesc(function($student){
                if($student->score === null){
                    return -1;
                }
                return $student->score;
            })->values();
    }

    public function getPercentile($student)
    {
        $sorted = $this->studentScores()->sort()->values();

        foreach($sorted as $key => $item)
        {
            $percentile[] = round((100 * $key)/($sorted->count() + 1));
        }
    }
}
