@extends('base')
@section('title', 'Новый тест')
@section('content')
    @include('basic_header')
    {{-- This comment will not be present in the rendered HTML    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h1>Тестовые данные</h1>
                <h3>Название</h3>
                <form action="" method="POST">
                    <input type="text" name="test[title]">
                    <h3>Описание</h3>
                    <input type="text" name="test[description]">
                    <h3>Минимум</h3>
                    <input type="text" name="test[minimum]">
                    <h1>Теги</h1>
                    <input type="text" name="tags[]">
                    <input type="text" name="tags[]">
                    <h1>Вопрос 1</h1>
                    <input type="text" name="questions[question1][]">
                    <h3>Ответы</h3>
                    <input type="text" name="questions[question1][answers][]">
                    <input type="text" name="questions[question1][answers][]">
                    <b>Правильный ответ</b>
                    <input type="checkbox" name="correctAnswers[question1][]" value="0">
                    <input type="checkbox" name="correctAnswers[question1][]" value="1">
                    <h1>Вопрос 2</h1>
                    <input type="text" name="questions[question2][]">
                    <h3>Ответы</h3>
                    <input type="text" name="questions[question2][answers][]">
                    <input type="text" name="questions[question2][answers][]">
                    <b>Правильный ответ</b>
                    <input type="checkbox" name="correctAnswers[question2][]" value="0">
                    <input type="checkbox" name="correctAnswers[question2][]" value="1">
                    <button type="submit" class="btn btn-outline-info">Пройти тест</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
   --}}
    <div id="editor"></div>
@endsection
