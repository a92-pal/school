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

Auth::routes(['register' => false]);

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::resource('student', 'UserDetailController')->middleware('auth');
Route::resource('teacher', 'TeacherDetailController')->middleware('auth');
Route::resource('vacation', 'VacationController');

Route::post('/teacher_image','ProfileController@changeTeacherImage')->name('teacher_image');
Route::post('/student_image','ProfileController@changeStudentImage')->name('student_image');
Route::post('/teacher_password','ProfileController@changeTeacherPassword')->name('teacher_password');
Route::post('/student_password','ProfileController@changeStudentPassword')->name('student_password');
Route::get('/choose-classe-for-schedule','RoutinDayController@classesScheduleViewForAll')->name('classes.schedule');
Route::get('/class_schedule/{id}','RoutinDayController@classSchedule')->name('class.schedule');
Route::post('/fetch_schedule','RoutinDayController@schedule')->name('schedule');

Route::group(['middleware'=>['auth']],function(){
    Route::post('/roll_info_during_addmission','UserDetailController@rollInfo')->name('roll.info');

    Route::get('/class_routin','RoutinDayController@index')->name('class.routin');
    Route::get('/routin/{id}','RoutinDayController@classForm')->name('routin');
    Route::post('/set_routin','RoutinDayController@setRoutin')->name('setRoutin');
    Route::get('/routin_daysetup/{id}','RoutinDayController@routinDaySetup')->name('routin.daysetup');
    Route::post('/routin_dayForm','RoutinDayController@routinDayForm')->name('routinDayForm');
    Route::post('/routin_dayStore','RoutinDayController@routinDayStore')->name('routinDayStore');

    Route::get('/class_attendance','AttendanceController@index')->name('class.attendance');
    Route::get('/attendance/{id}','AttendanceController@attendanceDateSelect')->name('attendance_form');
    Route::post('/attendance','AttendanceController@attendanceForm')->name('attendance');
    Route::post('/attendanceSubmit','AttendanceController@storeAttendance')->name('store.attendance');

    Route::get('/teacher_attendance','AttendanceController@teacherIndex')->name('teacher.attendance');
    Route::get('/daily_class_schedule','RoutinDayController@teacherRoutin')->name('teacher.routin');
    
});

Route::fallback(function() {
    abort(404);
});
