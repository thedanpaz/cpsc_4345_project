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
                        <div class="card-header">Grades</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('post-course-grade') }}">
                                @csrf
                                <input type="hidden" name="section" value="{{ $courseSectionId }}" />
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Midterm Grade</th>
                                        <th scope="col">Final Exam Grade</th>
                                        <th scope="col">Calculated Average</th>
                                        <th scope="col">Final Course Grade</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($registrants as $key=>$registrant)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td scope="row">{{ $registrant->midterm_exam_grade }}</td>
                                            <td scope="row">{{ $registrant->final_exam_grade }}</td>
                                            <td scope="row">
                                                {{ ((empty($registrant->midterm_exam_grade) ? 0 : $registrant->midterm_exam_grade) + (empty($registrant->final_exam_grade) ? 0 : $registrant->final_exam_grade)) / 2 }}
                                            </td>
                                            <td scope="row">
                                                <div class="form-group">
                                                    <label for="courseGrade[{{ $registrant->id }}][grade]" class="sr-only">Grade for #{{ $key }}</label>
                                                    <select class="form-control" id="courseGrade[{{ $registrant->id }}][grade]" name="courseGrade[{{ $registrant->id }}][grade]">
                                                        <option>Choose Grade</option>
                                                        @foreach($gradeTable as $grade)
                                                            <option value="{{ $grade }}" @if(strtolower($grade) == strtolower($registrant->final_course_grade)) selected="selected" @endif  >{{ $grade }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="existingCourseGrade[{{ $registrant->id }}][grade]" value="{{ $registrant->final_course_grade }}" />
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Submit Grades') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
