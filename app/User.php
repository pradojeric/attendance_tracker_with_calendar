<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForMail($notification)
    {
        // // Return email address only...
        // return $this->email;

        // Return name and email address...
        return [$this->email => $this->name];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRoleAttribute()
    {
        return $this->roles()->pluck('role')->first();
    }

    public function attendances()
    {
        return $this->belongsToMany(Attendance::class, 'attendance_students', 'student_id', 'attendance_id')->as('attendance')->withTimestamps();
    }

    public function presentTo($attendance)
    {
        $this->attendances()->syncWithoutDetaching($attendance);
    }

    public function getPresentDateAttribute()
    {
        return date('D, m-d-Y', strtotime($this->attendance->created_at));
    }

    public function getPresentTimeAttribute()
    {
        return date('h:i A', strtotime($this->attendance->created_at));
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_user', 'student_id' ,'room_id');
    }

    public function assignments()
    {
        //return $this->hasManyThrough(Assignment::class, RoomUser::class, 'student_id', 'room_id', 'id', 'room_id');
        return $this->rooms->map->assignments->flatten();
    }

    public function finishedAssignments()
    {
        return $this->belongsToMany(Assignment::class, 'assignment_student', 'student_id', 'assignment_id')->withTimestamps();
    }

    public function roomTeacher()
    {
        return $this->hasMany(Room::class, 'teacher_id');
    }

    public function isAdmin()
    {
        if($this->role == 'admin') return true;
    }

    public function isTeacher()
    {
        if($this->role == 'teacher') return true;
    }

    public function isStudent()
    {
        if($this->role == 'student') return true;
    }

    public function isPresent($attendance)
    {
        if($this->attendances->contains($attendance)) return true;
    }

    public function isLate($attendance)
    {
        if (new \DateTime(strtotime($this->present_date)) > new \DateTime(strtotime($attendance->attendance_date))) return true;
    }
}
