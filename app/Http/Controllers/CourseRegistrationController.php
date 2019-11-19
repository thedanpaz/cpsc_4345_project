<?php

namespace App\Http\Controllers;

use App\CourseRegistration;

use Illuminate\Http\Request;
use App\CourseSection;
use Illuminate\Support\Facades\Auth;

class CourseRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::check()) {

            $registrations = Auth::user()->universityPerson->registrations;

            return view('registrations', ['registrations' => $registrations]);

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGrade(Request $request)
    {

        $recordUpdated = 0;

        foreach($request->courseGrade as $registraintId => $grade) {

            if((empty($grade) OR strtolower($grade['grade']) == 'choose grade') AND empty($request->existingCourseGrade[$registraintId]['grade'])) {

                // No grade to assign, continue on
                continue;

            }

            $registrant = CourseRegistration::where('id', $registraintId)
                ->first();

            if(!empty($registrant)) {

                if(strtolower($grade['grade']) != 'choose grade') {

                    $recordUpdated++;

                }

                $registrant->final_course_grade = strtolower($grade['grade']) == 'choose grade' ? null : $grade['grade'];
                $registrant->save();

            }

        }

        $courseSections = CourseSection::where('id', $request->section)
            ->first();

        if($recordUpdated == $courseSections->registrations->count()) {

            $courseSections->final_course_grade_complete = true;
            $courseSections->save();

        } else {

            $courseSections->final_course_grade_complete = false;
            $courseSections->save();

        }


        return redirect()->route('show-section', $request->section);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseRegistration  $courseRegistration
     * @return \Illuminate\Http\Response
     */
    public function show(CourseRegistration $courseRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CourseRegistration  $courseRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseRegistration $courseRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseRegistration  $courseRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseRegistration $courseRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseRegistration  $courseRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseRegistration $courseRegistration)
    {
        //
    }
}
