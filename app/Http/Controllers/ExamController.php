<?php

namespace App\Http\Controllers;

use App\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }


    public function showCalculatedExam($course_section_id, $exam_type)
    {

        if(Auth::check()) {

            $exam = Exam::where('term', 'Fall 2019')
                ->where('course_section_id', $course_section_id)
                ->where('exam_type', $exam_type)
                ->first();

            if($exam_type == 'midterm') {

                $anonymousId = Auth::user()->universityPerson->midtermAnonymousId;

            } else {

                $anonymousId = Auth::user()->universityPerson->finalAnonymousId;

            }

            if(empty($exam)) {

                // todo - throw exception, Exam not found

            }


            return view('exam', [
                'questions' => $exam->questions,
                'exam_id' => $exam->id,
                'examinee_id' => $anonymousId->id
            ]);

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
