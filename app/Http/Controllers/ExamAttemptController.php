<?php

namespace App\Http\Controllers;

use App\AnonymousIdNumber;
use App\CourseRegistration;
use App\ExamAttempt;
use App\QuestionAttemptAnswer;
use App\QuestionOption;
use Illuminate\Http\Request;

class ExamAttemptController extends Controller
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

        // Store the Exam Attempt
        $examAttempt = new ExamAttempt();
        $examAttempt->exam_id = $request->exam_id;
        $examAttempt->examinee_id = $request->examinee_id;
        $examAttempt->grade = 0;
        $examAttempt->complete = true;
        $examAttempt->save();

        $correctness = [];


        // Store Exam Responses
        foreach($request->all() as $key=>$question_answer_id) {

            preg_match('/question-/', $key, $validateArray);

            if(empty($validateArray)) {

                continue;

            }

            $questionId = preg_replace('/question-/', '', $key);

            $questionAnswers = new QuestionAttemptAnswer();
            $questionAnswers->question_option_id = $question_answer_id;
            $questionAnswers->exam_attempt_id = $examAttempt->id;
            $questionAnswers->save();

            // check to see if the answer is correct
            $questionOption = QuestionOption::where('id', $question_answer_id)
                ->first();

            $correctness[] = $questionOption->correct_answer;

        }

        // Calculate grade
        $grade = round(array_sum($correctness)/count($correctness) * 100);

        $examAttempt->grade = $grade;
        $examAttempt->save();

        // Update the Registration Grade
        $anonymousId = AnonymousIdNumber::where('id', $request->examinee_id)
            ->first();

        $registration = CourseRegistration::where('registrant_university_id', $anonymousId->universityPerson->university_id_number)
            ->where('course_section_id', $examAttempt->exam->section->id)
            ->first();

        $registration->{$examAttempt->exam->exam_type . '_exam_grade'} = $grade;
        $registration->save();

        return redirect()->route('list-registrations');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExamAttempt  $examAttempt
     * @return \Illuminate\Http\Response
     */
    public function show(ExamAttempt $examAttempt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamAttempt  $examAttempt
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamAttempt $examAttempt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamAttempt  $examAttempt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamAttempt $examAttempt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamAttempt  $examAttempt
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamAttempt $examAttempt)
    {
        //
    }
}
