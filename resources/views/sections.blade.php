@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Course Sections for {{ $term }}</div>
                    <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Term</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Course Title</th>
                                    <th scope="col">Credit Hours</th>
                                    <th scope="col">Faculty</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sections as $section)
                                    <tr>
                                        <td>{{ $section->term }}</td>
                                        <td>{{ $section->course->subject_cd }} {{ $section->course->number }}</td>
                                        <td>{{ $section->course->title }}</td>
                                        <td>{{ $section->credit_hours }}</td>
                                        <td>{{ $section->professor->first_name }} {{ $section->professor->last_name }}</td>
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
