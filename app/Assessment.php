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
        return $this->belongsToMany(User::class, 'assessment_student', 'assessment_id', 'student_id')->withTimestamps();
    }
}
