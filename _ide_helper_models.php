<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Assessment
 *
 * @property int $id
 * @property int $room_id
 * @property string $title
 * @property string $description
 * @property int $total
 * @property string $deadline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Room $room
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assessment whereUpdatedAt($value)
 */
	class Assessment extends \Eloquent {}
}

namespace App{
/**
 * App\Assignment
 *
 * @property int $id
 * @property int $room_id
 * @property string $title
 * @property string $description
 * @property string $deadline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Room $room
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Assignment whereUpdatedAt($value)
 */
	class Assignment extends \Eloquent {}
}

namespace App{
/**
 * App\Attendance
 *
 * @property int $id
 * @property int $schedule_id
 * @property string $description
 * @property string $attendance_date
 * @property int $attendance
 * @property string $expiry_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $created_date
 * @property-read \App\Schedule $schedule
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereAttendance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereAttendanceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereExpiryTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Attendance whereUpdatedAt($value)
 */
	class Attendance extends \Eloquent {}
}

namespace App{
/**
 * App\AttendanceStudent
 *
 * @property int $id
 * @property int $attendance_id
 * @property int $student_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceStudent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceStudent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceStudent query()
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceStudent whereAttendanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceStudent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceStudent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceStudent whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AttendanceStudent whereUpdatedAt($value)
 */
	class AttendanceStudent extends \Eloquent {}
}

namespace App{
/**
 * App\Role
 *
 * @property int $id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App{
/**
 * App\RoleUser
 *
 * @property int $role_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereUserId($value)
 */
	class RoleUser extends \Eloquent {}
}

namespace App{
/**
 * App\Room
 *
 * @property int $id
 * @property int $teacher_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assessment[] $assessments
 * @property-read int|null $assessments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $assignments
 * @property-read int|null $assignments_count
 * @property-read mixed $teacher_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Schedule[] $schedules
 * @property-read int|null $schedules_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $students
 * @property-read int|null $students_count
 * @property-read \App\User $teacher
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedAt($value)
 */
	class Room extends \Eloquent {}
}

namespace App{
/**
 * App\RoomUser
 *
 * @property int $id
 * @property int $room_id
 * @property int $student_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoomUser whereUpdatedAt($value)
 */
	class RoomUser extends \Eloquent {}
}

namespace App{
/**
 * App\Schedule
 *
 * @property int $id
 * @property int $room_id
 * @property string $day
 * @property string $start_class
 * @property string $end_class
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attendance[] $attendances
 * @property-read int|null $attendances_count
 * @property-read mixed $schedule_time
 * @property-read \App\Room $room
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereEndClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStartClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUpdatedAt($value)
 */
	class Schedule extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attendance[] $attendances
 * @property-read int|null $attendances_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assessment[] $finishedAssessments
 * @property-read int|null $finished_assessments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Assignment[] $finishedAssignments
 * @property-read int|null $finished_assignments_count
 * @property-read mixed $present_date
 * @property-read mixed $present_time
 * @property-read mixed $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Room[] $roomTeacher
 * @property-read int|null $room_teacher_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Room[] $rooms
 * @property-read int|null $rooms_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

