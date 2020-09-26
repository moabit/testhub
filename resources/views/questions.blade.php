@extends('base')
@section('title', $test->title)
@section('content')
    @include('basic_header')
    <div class="container mt-4">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="false" aria-controls="collapseOne">
                            {{$test->title}}
                        </button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        {{$test->description}}
                    </div>
                </div>
            </div>
        </div>
        <form action="" method="POST">
            @foreach ($questions as $question)
                <input type="hidden" name="test[questions][{{$question->id}}][id]" value="{{$question->id}}" >
                <div class="card m-0 mt-3 p-2">
                    <div class="row">
                        <div class="col-sm-7">
                            <p>
                                <span class="font-weight-bold">{{$loop->iteration}}. </span>
                                {{$question->question}}</p>
                        </div>
                    </div>
                    <div class="row">
                        @if (!$question->isMultipleChoiceQuestion())
                            <div class="col-sm">
                                <input type="text" placeholder="Напишите ваш ответ" name="test[questions][{{$question->id}}][answers][]">
                            </div>
                    </div>
                    @else
                        @foreach ($question->answers as $answer)
                            <div class="col-sm">
                                <div class="form-check">
                                    @if($question->hasOnlyOneCorrectAnswer())
                                        <input class="form-check-input" type="radio"
                                               name="test[questions][{{$question->id}}][answers][]"
                                               value="{{$answer->id}}">
                                        <label class="form-check-label">
                                            {{$answer->answer}}
                                        </label>
                                </div>
                                @else
                                    <input class="form-check-input" type="checkbox"
                                           name="test[questions][{{$question->id}}][answers][]" value="{{$answer->id}}">
                                    <label class="form-check-label">
                                        {{$answer->answer}}
                                    </label>
                            </div>
                            @endif
                </div>
        @endforeach
    </div>
    @endif
    </div>
    @endforeach
    <div class="row">
        <div class="col-sm m-0 mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">Завершить тест</button>
        </div>
    </div>
    </form>
    </div>
@endsection
