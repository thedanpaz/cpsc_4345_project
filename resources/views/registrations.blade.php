@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registered Courses</div>

                    <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Term</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Faculty</th>
                                    <th scope="col">Midterm Exam Grade</th>
                                    <th scope="col">Final Exam Grade</th>
                                    <th scope="col">Final Course Grade</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($registrations as $registration)
                                    <tr>
                                        <td>{{$registration->term }}</td>
                                        <td>{{$registration->section->course->subject_cd }} {{$registration->section->course->number }}: {{ $registration->section->course->title }} </td>
                                        <td>{{$registration->section->professor->first_name }} {{$registration->section->professor->last_name }} </td>
                                        <td>
                                            @if(!empty($registration->midterm_exam_grade))
                                                {{$registration->midterm_exam_grade }}
                                                </br>
                                                <small><a href="/exam/{{ $registration->course_section_id }}/midterm">
                                                        {{ __('Re-take Midterm Exam') }}
                                                    </a></small>
                                            @else
                                                <a href="/exam/{{ $registration->course_section_id }}/midterm" class="btn btn-primary">
                                                    {{ __('Take Midterm Exam') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($registration->final_exam_grade))
                                                {{$registration->final_exam_grade }}
                                                </br>
                                                <small><a href="/exam/{{ $registration->course_section_id }}/final">
                                                        {{ __('Re-take Final Exam') }}
                                                    </a></small>
                                            @else
                                                <a href="/exam/{{ $registration->course_section_id }}/final" class="btn btn-primary">
                                                    {{ __('Take Final Exam') }}
                                                </a>
                                            @endif
                                        <td>{{$registration->final_course_grade }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
