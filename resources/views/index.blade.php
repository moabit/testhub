@extends('base')
@section('content')
    @include('basic_header')
    <div class="container mt-4">
        <div class="row shadow p-3 mb-5 bg-white rounded">
            <div class="col-md-4 order-md-2 d-none d-md-block">
                <h4><strong>О нас</strong></h4>
                <p><strong>TestHub</strong> — это сервис, который позволяет вам легко создавать тесты для проверки знаний и
                    просматривать результаты в удобном интерфейсе. Для создания и прохождения теста не требуется
                    регистрация, но мы советуем это сделать, так как в этом случае вы легко сможете управлять своими
                    тестами.</p>
                <p>Присоединяйтесь к сообществу <strong>TestHub</strong></p>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-4"><strong>Самые популярные тесты</strong></h4>
                <div class="row mb-3 ">
                    <div class="col"><span class="text-secondary font-weight-bold">Тест</span></div>
                    <div class="col text-center"><span class="text-secondary font-weight-bold">Просмотры за месяц</span></div>
                </div>
                @foreach ($tests as $test)
                    <div class="row  border-bottom box-shadow mb-1">
                        <div class="col"><a href="{{url("/test/{$test->id}")}}">{{$test->title}}</a></div>
                        <div class="col font-weight-bold text-center">{{$test->attempts}}</div>
                    </div>
                    <div class="mt-2 mb-4">
                        @foreach ($test->tags as $tag)
                                <a href="search/tag/{{$tag->title}}" class="badge badge-info">{{$tag->title}}</a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
