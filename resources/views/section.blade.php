@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(auth::check())
                    <div class="card mb-5">
                        <div class="card-header">Course Section Details</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Property</th>
                                    <th scope="col">Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td scope="row">Course</td>
                                    <td>{{ $courseCd }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Course Name</td>
                                    <td>{{ $courseName }}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Section ID</td>
                                    <td>{{ $courseSectionId }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if(auth::user()->universityPerson->user_type == 'faculty')
                        <div class="card mb-5">
                            <div class="card-header">Roster</div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Student</th>
                                        @if($lockedFinalCourseGrade === 1 )
                                            <th scope="col">Midterm Grade</th>
                                            <th scope="col">Final Exam Grade</th>
                                            <th scope="col">Final Course Grade</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($registrants as $key=>$registrant)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td scope="row">{{ $registrant->person->first_name }} {{ $registrant->person->last_name }}</td>
                                            @if($lockedFinalCourseGrade === 1 )
                                                <td scope="row">{{ $registrant->midterm_exam_grade }}</td>
                                                <td scope="row">{{ $registrant->final_exam_grade }}</td>
                                                <td scope="row">{{ $registrant->final_course_grade }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col">
                                    <p>{{ $registrantsWithFinalGrade }} out of {{ $registrantsTotal }} Final grades assigned.</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ ($registrantsWithFinalGrade/$registrantsTotal) * 100 }}%" aria-valuenow="{{ ($registrantsWithFinalGrade/$registrantsTotal) * 100 }}" aria-valuemin="{{ $registrantsWithFinalGrade }}" aria-valuemax="{{ $registrantsTotal }}"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    @if($lockedFinalCourseGrade === 1 )
                                        <p>Final Course Grades have been submitted to the Registrar. Editing of final course is no longer permitted.</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col">
                                    @if($lockedFinalCourseGrade === 0 )
                                        <a href="{{ route('assign-final-course-grade', $courseSectionId) }}" class="btn btn-primary">
                                            {{ __('Assign Final Course Grades') }}
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-primary" disabled>
                                            {{ __('Assign Final Course Grades') }}
                                        </button>
                                    @endif
                                </div>
                                @if($finalCourseGradeComplete === 1)
                                    <div class="col">
                                        @if($lockedFinalCourseGrade === 0 )
                                            <a href="{{ route('lock-section-course-grades', $courseSectionId) }}" class="btn btn-danger">
                                                {{ __('Submit Final Course Grades to Registrar') }}
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-danger" disabled>
                                                {{ __('Submit Final Course Grades to Registrar') }}
                                            </button>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
