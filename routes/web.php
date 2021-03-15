<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, 'reset' => false
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){

    Route::resource('rooms', 'RoomController');
    Route::post('/attendance/add', 'AttendanceController@addAttendance')->name('add_attendance');
    Route::get('/attendance/view/{attendance}', 'AttendanceController@viewAttendance')->name('view_attendance');
    Route::put('/attendance/update/{attendance}', 'AttendanceController@activateAttendance')->name('activate_attendance');
    Route::delete('/attendance/delete/{attendance}', 'AttendanceController@deleteAttendance')->name('delete_attendance');

    Route::get('/show/attendance/{room}', 'AttendanceController@getStudentAttendances')->name('student_attendance_show');
    Route::post('/attend/{attendance}', 'AttendanceController@studentAttend')->name('student_attendance');

    Route::post('/attendance/get/{room}', 'AttendanceController@getAttendances');

    Route::get('/test/', function(){
        if( App\User::find(4)->attendances->where('pivot.schedule_id', 2)->where('pivot.attendance_date', date('Y-m-d', strtotime(now())))->flatten()->pluck('pivot.attendance_date')){
            return true;
        }
        return false;
    });

});
