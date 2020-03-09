@extends('base')
@section('title')
    <title>Тупичок Гоблина</title>
@endsection

@section('content')
    @include('basic_header')
    <div class="container">
        <div class="row shadow p-3 mb-5 bg-white rounded ">
            <div class="col">
                <h2>{{$test->title}}</h2>
                <div class="mb-4">
                @foreach($test->tags as $tag)
                    <span class="badge badge-info">{{$tag->title}}</span>
                @endforeach
                </div>
                <p class="mb-4">{{$test->description}}</p>
                <p>Время на выполнение: {{$test->time_limit}}</p>
                <form action="" method="POST">
                    <button type="submit" class="btn btn-outline-info">Пройти тест</button>
                    @csrf
                </form>
            </div>
        </div>
@endsection
