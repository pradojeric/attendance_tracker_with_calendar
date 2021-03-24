<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $guarded = [];

    public function students()
    {
        return $this->belongsToMany(User::class, 'room_user', 'room_id', 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function getTeacherNameAttribute()
    {
        return $this->teacher->name;
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}
