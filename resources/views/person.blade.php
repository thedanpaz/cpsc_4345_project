@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(auth::check())
                    <div class="card mb-5">
                        <div class="card-header">Your Ethical University Account:</div>

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
                                    <td>Email</td>
                                    <td>{{ auth::user()->email }}</td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td>{{ auth::user()->universityPerson->first_name }}</td>
                                </tr>
                                <tr>
                                    <td>Preferred First Name</td>
                                    <td>{{ auth::user()->universityPerson->preferred_first_name }}</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td>{{ auth::user()->universityPerson->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>User Type</td>
                                    <td>{{ auth::user()->universityPerson->user_type }}</td>
                                </tr>
                                @if(auth::user()->universityPerson->user_type == 'student')
                                    <tr>
                                        <td>Midterm Anonymous ID</td>
                                        <td>{{ auth::user()->universityPerson->midtermAnonymousId->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Final Anonymous ID</td>
                                        <td>{{ auth::user()->universityPerson->finalAnonymousId->id }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">Available Actions</div>
                        <div class="card-body">
                            @if(auth::user()->universityPerson->user_type == 'faculty')
                                <ul>
                                    <li><a href="{{ route('list-sections-assigned', 'fall-2019') }}">View My Sections</a></li>
                                    <li><a href="{{ route('show-term-courses', 'fall-2019') }}">View Course List for Fall 2019</a></li>
                                    <li><a href="#">Update Person Record</a></li>
                                </ul>
                            @elseif(auth::user()->universityPerson->user_type == 'student')
                                <ul>
                                    <li><a href="{{ route('list-registrations') }}">View My Course Registrations</a></li>
                                    <li><a href="{{ route('show-term-courses', 'fall-2019') }}">View Course List for Fall 2019</a></li>
                                    <li><a href="#">Update Person Record</a></li> {{--  todo - Update with live link  --}}
                                </ul>
                            @endif
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
@endsection
