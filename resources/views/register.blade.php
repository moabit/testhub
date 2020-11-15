@extends('base')
@section('title', 'Регистрация')
@include('basic_header')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center">
                Регистрация
            </div>
            <form method="POST" action="">
                <div class="row justify-content-center form-group  p-3">
                    <div class="col-2">
                        <label for="inputName">Ваше имя</label>
                    </div>
                    <div class="col-3">
                        <input type="text" name="name" class="form-control" id="inputName">
                    </div>
                </div>
                <div class="row justify-content-center form-group  p-3">
                    <div class="col-2">
                        <label for="inputEmail">E-mail</label>
                    </div>
                    <div class="col-3">
                        <input type="email" name="email" class="form-control" id="inputEmail">
                    </div>
                </div>
                <div class="row justify-content-center form-group p-3">
                    <div class="col-2">
                        <label for="inputPassword">Пароль</label>
                    </div>
                    <div class="col-3">
                        <input type="password" name="password" class="form-control" id="inputPassword">
                        <span class="text-muted">Здесь будут правила валидации</span>
                    </div>
                </div>
                <div class="row justify-content-center form-group p-3">
                    <div class="col-2">
                        <label for="inputPassword2">Еще раз</label>
                    </div>
                    <div class="col-3">
                        <input type="password" name="password_confirmation" class="form-control" id="inputPassword2">
                    </div>
                </div>
                <div class="row justify-content-center form-group p-3">
                    <div class="col-5">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
                    </div>
                </div>
            </form>
    </div>
@endsection
