@extends('base')
@section('title', 'Результат теста: '. session('testTitle'))
@section('content')
    @include('basic_header')
    <div class="container mt-4 shadow p-3 mb-5 bg-white rounded">
        <div class="card  {{session('status')=='passed'?'border-success':'border-danger'}}">
            <div class="card-header">
                {{session('testTitle')}}
            </div>
            <div class="card-body">
                <h5 class="card-title {{session('status')=='passed'?'text-success':'text-danger'}}">
                    @if(session('status')=='passed')
                        Вы успешно прошли тест
                    @elseif(session('status')=='timeElapsed')
                        Время на выполнение теста истекло
                    @else
                        Вы не прошли тест
                    @endif
                </h5>
                <p class="card-text"><span class="font-weight-bold">Правильные ответы: </span>{{session('result')}} из
                    {{session('questionsCount')}}</p>
                <p class="card-text"><span class="font-weight-bold">Потраченное время: </span>{{session('timeSpent')}}
                </p>
                <a href="/" class="btn btn-primary">На главную</a>
            </div>
        </div>
    </div>
@endsection
