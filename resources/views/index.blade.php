@extends('base')
@section('title')
    <title>Testhub</title>
@endsection
@section('content')
    @include('basic_header')
    <div class="container">
        <h5>Попробовать свои силы</h5>
        <div class="row shadow p-3 mb-5 bg-white rounded">
            <div class="col-md-4 order-md-2">
                <h4>О нас</h4>
                <p>TestHub — это сервис, который позволяет вам легко создавать тесты для проверки знаний и
                    просматривать результаты в удобном интерфейсе. Для создания и прохождения теста не требуется
                    регистрация, но мы советуем это сделать, так как в этом случае вы легко сможете управлять своими
                    тестами.</p>
                <p>Присоединяйтесь к сообществу TestHub</p>
            </div>
            <div class="col-md-8 order-md-1">
                @foreach ($tests as $test)
                    <div class="row  border-bottom box-shadow mb-1">
                        <div class="col"><a href="{{url("/test/{$test->id}")}}">{{$test->title}}</a></div>
                        <div class="col">Просмотры: {{$test->views}}</div>
                    </div>
                    <div class="row mb-4 d-inline-flex">
                        @foreach ($test->tags as $tag)
                            <div class="col">
                                <span class="badge badge-primary">{{$tag->title}}</span>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
