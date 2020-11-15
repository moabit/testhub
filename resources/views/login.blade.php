@extends('base')
@section('title', 'Войти c паролем')
@include('basic_header')
@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center">
                Вход с паролем
            </div>
            <form method="POST" action="">
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
                        <span class="text-muted">Если вы забыли пароль, то <a href="/" class="text-muted">нажмите сюда</a></span>
                    </div>
                </div>
                    <div class="row justify-content-center form-group p-3">
                        <div class="col-5">
                        <button type="submit" class="btn btn-primary btn-block">Войти</button>
                        </div>
                    </div>
                <div class="row justify-content-center form-group">
                    <div class="col-4">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                        @csrf
                    <label class="form-check-label" for="rememberMe">Запомнить меня</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
