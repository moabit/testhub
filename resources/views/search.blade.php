@extends('base')
@section('title', 'Резльтаты поиска по тегу ')
@section('content')
    @include('basic_header')
    <div class="container mt-4">
        <div class=" shadow p-3 mb-5 bg-white rounded">
            <div>
                @if($tests->count()>0)
                    <span>Найдено тестов по @if($tag) тегу <span class="badge badge-info">{{$tag}}</span>@else по запросу <span class="font-italic">{{$title}}</span> @endif: {{$tests->count()}}</span>
                @else
                    <span>По вашему запросу ничего не найдено</span>
                @endif
            </div>
            @foreach($tests as $test)
            <div class="border-top border-bottom mt-1">
                <strong>{{$test->title}}</strong>
               <p>
                   {{$test->getTruncatedDescription()}}
               </p>
                <div>
                    <a href="/test/{{$test->id}}">Открыть страницу теста</a>
                </div>
            </div>
            @endforeach
            {{$tests->appends(request()->query())->links()}}
        </div>
    </div>



@endsection
