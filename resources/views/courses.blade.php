@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Course Listing</div>

                    <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Course</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Sections</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td>{{ $course->subject_cd }} {{ $course->number }}</td>
                                        <td>{{ $course->title }}</td>
                                        <td></td>
{{--                                        <td><a href="{{ route('show-course', 'fall-2019') }}" class="btn btn-primary">--}}
{{--                                                {{ __('Show Sections for Fall 2019') }}--}}
{{--                                            </a></td>--}}
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
