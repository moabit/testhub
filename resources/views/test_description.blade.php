@extends('base')
@section('title', $test->title)
@section('content')
    @include('basic_header')
    <div class="container mt-4">
        <div class="row shadow p-3 mb-5 bg-white rounded">
            <div class="col">
                <h2>{{$test->title}}</h2>
                <div class="mb-4">
                @foreach($test->tags as $tag)
                    <a href='/search/tag/{{$tag->title}}' class="badge badge-info">{{$tag->title}}</a>
                @endforeach
                </div>
                <p class="text-secondary test-description font-weight-bold">Описание</p>
                <p class="mb-4">{{$test->description}}</p>
                @unless($test->time_limit == null)
                    <p class="font-weight-bold m-0">Время на выполнение: {{$test->time_limit}} минут</p>
                @endunless
                <p class="font-weight-bold mb-3">Количество вопросов: {{$test->questions->count()}}</p>
                <form action="" method="POST">
                    <button type="submit" class="btn btn-outline-primary">Пройти тест</button>
                    @csrf
                </form>
            </div>
        </div>
@endsection
