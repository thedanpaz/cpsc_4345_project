@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Auth::check())
                    @if(empty(Auth::user()->universityPerson))
                        <div class="card">
                        <div class="card-header">Activate your Ethical University Account.</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('create-person') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

                                    <div class="col-md-6">
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="preferred_first_name" class="col-md-4 col-form-label text-md-right">Preferred First Name</label>

                                    <div class="col-md-6">
                                        <input id="preferred_first_name" type="text" class="form-control @error('preferred_first_name') is-invalid @enderror" name="preferred_first_name" value="{{ old('preferred_first_name') }}" required autocomplete="preferred_first_name" autofocus>

                                        @error('preferred_first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                                    <div class="col-md-6">
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="user_type" class="col-md-4 col-form-label text-md-right">User Type</label>

                                    <div class="col-md-6">
                                        <select name="user_type" class="form-control @error('user_type') is-invalid @enderror">
                                            <option>Select User Type</option>
                                            <option value="student">Student</option>
                                            <option value="staff">Staff</option>
                                            <option value="faculty">Faculty</option>
                                        </select>

                                        @error('user_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Activate') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @else
                        <div class="card">
                            <div class="card-header">Your University Account is already Active</div>

                            <div class="card-body">
                                <div class="row">
                                    <p>Your University account is already set up. Visit your account review page for your details.</p>
                                    <a href="{{ route('show-person') }}" class="btn btn-primary">
                                        {{ __('University Account Details') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
