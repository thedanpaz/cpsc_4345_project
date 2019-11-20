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

    if(Auth::check()) {


        // Check to see if the user has a universityPerson
        if(empty(Auth::user()->universityPerson)) {

            return redirect()->route('create-person-form');

        } else {

//            return redirect()->route('show-person');
            return view('person');

        }

    }

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Show person data based on Auth
Route::get('/person', 'PersonController@show')->name('show-person');

// Show form to create a person record, aka ACTIVATE account
Route::get('/person/create', 'PersonController@create')->name('create-person-form');

// Store a person record from form
Route::post('/person/create', 'PersonController@store')->name('create-person');

// Show course list
Route::get('/course/list', 'CourseController@index')->name('list-courses');

// Show sections list for X term
Route::get('/course/{term}/list', 'CourseSectionController@index')->name('show-term-courses');

// List registered Sections
Route::get('/registration', 'CourseRegistrationController@index')->name('list-registrations');

// Show Midterm Exam for auth user
Route::get('/exam/{course_section_id}/{exam_type}', 'ExamController@showCalculatedExam')->name('show-exam');
Route::post('/exam/submit', 'ExamAttemptController@store')->name('store-exam-attempt');

// List assigned Sections
Route::get('/sections-assigned/{term}', 'CourseSectionController@indexByAuthPerson')->name('list-sections-assigned');

// List assigned Sections
Route::get('/section/{courseSection}', 'CourseSectionController@show')->name('show-section');

// List assigned Sections
Route::get('/section/{courseSection}/lock-grades', 'CourseSectionController@lockCourseGrade')->name('lock-section-course-grades');

// List assigned Sections
Route::get('/section/{courseSection}/final-course-grades', 'CourseSectionController@assignFinalCourseGrade')->name('assign-final-course-grade');

// List assigned Sections
Route::post('/registration/post-course-grades', 'CourseRegistrationController@storeGrade')->name('post-course-grade');

