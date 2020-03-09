@extends('base')
@section('title')
    <title>TestHub </title>
@endsection

@section('content')
@include('basic_header')
<div class="container">
    <div class="row shadow p-3 mb-5 bg-white rounded">
        <div class="col">
            <h2>{{session('testTitle')}}</h2>
            <p>
                Ваш Результат: {{session('result')}}
            </p>
        </div>
    </div>
</div>

@endsection
