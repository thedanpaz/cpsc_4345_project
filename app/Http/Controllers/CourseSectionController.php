<?php

namespace App\Http\Controllers;

use App\CourseSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CourseSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($term = null)
    {

        $term = preg_replace('/[^A-Za-z0-9]/', ' ', $term);

        if(!empty($term)) {

            $courseSections = CourseSection::where('term', str_replace(['-', '_'], ' ', $term))
                ->get();

        } else {

            $courseSections = CourseSection::get();

        }

        return view('sections', ['term' => $term, 'sections' => $courseSections]);

    }

    public function indexByAuthPerson($term = null)
    {

        if(Auth::check()) {

            $term = preg_replace('/[^A-Za-z0-9]/', ' ', $term);

            if (!empty($term)) {

                $courseSections = CourseSection::where('term', str_replace(['-', '_'], ' ', $term))
                    ->where('faculty', Auth::user()->universityPerson->university_id_number)
                    ->get();

            } else {

                $courseSections = CourseSection::get();

            }

            return view('sections-assigned', [
                'term' => $term,
                'sections' => $courseSections,
                'facultyName' => Auth::user()->universityPerson->first_name . ' ' . Auth::user()->universityPerson->last_name
            ]);

        }

    }

    public function lockCourseGrade(CourseSection $courseSection)
    {

        if($courseSection->final_course_grade_complete === 1) {

            $courseSection->lock_final_course_grade = 1;
            $courseSection->save();

        }

        return redirect()->route('show-section', $courseSection->id);

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
     * Display the specified resource.
     *
     * @param  \App\CourseSection  $courseSection
     * @return \Illuminate\Http\Response
     */
    public function show(CourseSection $courseSection)
    {

        $registrationWithFinalCourseGrade = 0;

        foreach($courseSection->registrations as $registration) {

            if(!empty($registration->final_course_grade)) {

                $registrationWithFinalCourseGrade++;

            }

        }



        return view('section', [
            'courseName' => $courseSection->course->title,
            'courseCd' => $courseSection->course->subject_cd . ' ' . $courseSection->course->number,
            'courseSectionId' => $courseSection->id,
            'registrants' => $courseSection->registrations,
            'registrantsTotal' => $courseSection->registrations->count(),
            'registrantsWithFinalGrade' => $registrationWithFinalCourseGrade,
            'finalCourseGradeComplete' => $courseSection->final_course_grade_complete,
            'lockedFinalCourseGrade' => $courseSection->lock_final_course_grade
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseSection  $courseSection
     * @return \Illuminate\Http\Response
     */
    public function assignFinalCourseGrade(CourseSection $courseSection)
    {

        return view('final-course-grade', [
            'courseName' => $courseSection->course->title,
            'courseCd' => $courseSection->course->subject_cd . ' ' . $courseSection->course->number,
            'courseSectionId' => $courseSection->id,
            'registrants' => $courseSection->registrations,
            'gradeTable' => [
                'A', 'B', 'C', 'D', 'F'
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CourseSection  $courseSection
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseSection $courseSection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseSection  $courseSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseSection $courseSection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CourseSection  $courseSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseSection $courseSection)
    {
        //
    }
}
