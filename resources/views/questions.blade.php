@extends('base')
@section('title')
    <title>Тупичок Гоблина</title>
@endsection
@section('content')
    <div class="container">
        <h1>Самый заебатый сайт</h1>
        <h2>Топчик тестов</h2>
        <form action="" method="POST">
            @foreach ($questions as $question)
                <div class="border border-secondary m-3">
                    <div class="row ">
                        <div class="col-sm-7">
                            <p>{{$question->question}}</p>
                        </div>
                    </div>
                    <div class="row">
                        @if ($question->type=='open')
                            <div class="col-sm">
                                <input type="text" name="question_{{$question->id}}[]">
                            </div>
                        @else
                            @foreach ($question->answers as $answer)
                                <div class="col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                               name="question_{{$question->id}}[]" value="{{$answer->answer}}">
                                        <label class="form-check-label">
                                            {{$answer->answer}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                    @endif
                </div>
            @endforeach
            <div class="row">
                <div class="col-sm m-3">
                    @csrf
                    <button type="submit" class="btn btn-outline-info">Пройти тест</button>

                </div>
            </div>
        </form>
    </div>
@endsection
