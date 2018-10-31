<?php

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
  return view('auth.login');
});

//authentification goes here
Auth::routes();

//routes for admin starts here
Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::match(['GET','POST'],'admin/semses' ,'AdminController@semestersession')->name('admin.semses');
Route::match(['GET','POST'],'admin/levcou' ,'AdminController@levelcourse')->name('admin.levcou');
Route::match(['GET','POST'],'admin/registerlect', 'AdminController@registerlecturer')->name('admin.reglect');
Route::match(['GET','POST'],'admin/registerstud', 'AdminController@registerstudent')->name('admin.regstud');
Route::match(['GET','POST'],'admin/assigncourses','AdminController@assigncourses')->name('admin.assigncourses');
Route::match(['GET','POST'],'admin/assignstudents','AdminController@assignstudents')->name('admin.assignstudents');
Route::match(['GET','POST'],'admin/approveresults','AdminController@approveresults')->name('admin.approveresults');
Route::match(['GET','POST'],'admin/viewresults','AdminController@viewresults')->name('admin.viewresults');
Route::match(['GET','POST'],'admin/resultstatement','AdminController@resultstatement')->name('admin.resultstatement');
Route::match(['GET','POST'],'admin/profile','AdminController@admin_profile')->name('admin.profile');

Route::match(['GET','POST'],'admin/promote_students','AdminController@promote_students')->name('admin.promote_by_level');
Route::match(['GET','POST'],'admin/password_reset','AdminController@password_reset')->name('admin.password_reset');
Route::match(['GET','POST'],'admin/generate_classlist','AdminController@generate_classlist')->name('admin.generate_classlist');



//routes for leturers starts here
Route::get('lecturer/dashboard','LecturerController@dashboard')->name('lecturer.dashboard');

Route::match(['GET','POST'],'lecturer/l_courses' ,'LecturerController@lecturer_courses')->name('lecturer.courses');
Route::match(['GET','POST'],'lecturer/course_students' ,'LecturerController@course_students')->name('lecturer.course_students');

Route::match(['GET','POST'],'lecturer/l_students' ,'LecturerController@lecturer_students')->name('lecturer.students');
Route::match(['GET','POST'],'lecturer/unapproved_courses' ,'LecturerController@unapproved_student_course')->name('lecturer.unapproved');
Route::match(['GET','POST'],'lecturer/approved_courses' ,'LecturerController@approved_student_course')->name('lecturer.approved');

Route::match(['GET','POST'],'lecturer/course_results', 'LecturerController@course_results')->name('lecturer.course_results');
Route::match(['GET','POST'],'lecturer/students_results', 'LecturerController@students_results')->name('lecturer.students_results');
Route::match(['GET','POST'],'lecturer/upload_results', 'LecturerController@upload_results')->name('lecturer.upload_results');


Route::match(['GET','POST'],'lecturer/l_classlist', 'LecturerController@classlist')->name('lecturer.classlist');
Route::match(['GET','POST'],'lecturer/l_profile', 'LecturerController@lecturer_profile')->name('lecturer.profile');
Route::match(['GET','POST'],'lecturer_edit_profile', 'LecturerController@edit_profile')->name('lecturer_edit_profile');
Route::match(['GET','POST'],'lecturer_edit_profile_pic', 'LecturerController@edit_profile_pic')->name('lecturer_edit_profile_pic');


//routes for students starts here
Route::get('student/dashboard', 'StudentController@dashboard')->name('student.dashboard');


Route::match(['GET','POST'],'student/mycourses' ,'StudentController@mycourses')->name('student.mycourses');
Route::match(['GET','POST'],'student/registered_courses' ,'StudentController@registered_courses')->name('student.registered_courses');
Route::match(['GET','POST'],'student/register_courses' ,'StudentController@register_courses')->name('student.register_courses');


Route::match(['GET','POST'],'student_edit_registered/{id?}' ,'StudentController@edit_registered_dialog')->name('student.edit_registered_dialog');


Route::match(['GET','POST'],'student/results' ,'StudentController@view_results')->name('student.view_results');
Route::match(['GET','POST'],'student/cgpa' ,'StudentController@view_cgpa')->name('student.view_cgpa');
Route::match(['GET','POST'],'student/result_statement' ,'StudentController@result_statement')->name('student.result_statement');


Route::match(['GET','POST'],'student_profile', 'StudentController@profile')->name('student.profile');
Route::match(['GET','POST'],'student_edit_profile', 'StudentController@edit_profile')->name('student.edit_profile');
Route::match(['GET','POST'],'student_edit_profile_pic', 'StudentController@edit_profile_pic')->name('student.edit_profile_pic');


//routes for excel things(Lecturers)
Route::get('get_lecturer_excel/{type}', 'adminController@get_lecturer_excel')->name('get_lecturer_excel');
Route::post('upload_lecturer_excel', 'adminController@upload_lecturer_excel')->name('upload_lecturer_excel');

//routes for excel things(Students)
Route::get('get_students_excel/{type}', 'adminController@get_students_excel')->name('get_students_excel');
Route::post('upload_students_excel', 'adminController@upload_students_excel')->name('upload_students_excel');

//routes for excel things(Results)
Route::get('get_result_excel/{type}', 'LecturerController@get_result_excel')->name('get_result_excel');
Route::post('upload_result_excel', 'LecturerController@upload_result_excel')->name('upload_result_excel');
