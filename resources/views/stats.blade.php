@extends('base')
@section('title', 'Статистика')
@include('basic_header')
<div class="container mt-4">
    <div class="shadow p-3 mb-5 bg-white rounded">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тест</th>
                <th scope="col">Результат</th>
                <th scope="col">Время</th>
                <th scope="col">Дата</th>
            </tr>
            </thead>
            <tbody>
            @foreach($testResults as $testResult)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>{{$testResult->test->title}}</td>
                    <td>{{$testResult->score}}</td>
                    <td>{{$testResult->time_spent}}</td>
                    <td>{{$testResult->created_at->format('Y-m-d H:i')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@section('content')
@endsection
