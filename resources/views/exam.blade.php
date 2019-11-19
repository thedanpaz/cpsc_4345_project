@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Exam</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('store-exam-attempt') }}">
                            @csrf
                        @foreach($questions as $question)
                            <div class="row">
                                <div class="col">
                                    <p>{{ $question->question_copy }}</p>
                                    <ol>
                                        @foreach($question->options as $option)
                                            <li>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" name="question-{{ $question->id }}" value="{{ $option->id }}">
                                                    <label for="question-{{ $question->id }}" class="form-check-label">{{ $option->question_copy }}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                            <input type="hidden" name="exam_id" value="{{ $exam_id }}" />
                            <input type="hidden" name="examinee_id" value="{{ $examinee_id }}" />
                        @endforeach
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
