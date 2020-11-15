<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom box-shadow">
        <a class="navbar-brand" href="/">TestHub</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain"><span
                class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar nav ml-auto">
                @if (Request::is('/'))
                    <li class="nav-item m-2">
                        <a class="nav-link btn btn-outline-success" href="/new">Создать тест</a>
                    </li>
                @endif
                @if(Auth::check()==true)
                    <li class="nav-item m-2">
                        <a class="nav-link btn btn-outline-primary" href="/tests">Мои тесты</a>
                    </li>
                    <li class="nav-item m-2">
                        <a class="nav-link btn btn-outline-primary" href="/stats">Вы вошли
                            как {{Auth::user()->name}}</a>
                    </li>
                    <li class="nav-item m-2">
                        <form method="POST" action="/logout" class="m-0">
                            @csrf
                            <button type="submit" class="nav-link btn btn-outline-danger">Выйти</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item m-2">
                        <a class="nav-link btn btn-outline-primary" href="/register">Регистрация</a>
                    </li>
                    <li class="nav-item m-2">
                        <a class="nav-link btn btn-outline-primary" href="/login">Войти с паролем</a>
                    </li>
                @endif
                <li class="nav-item ml-2">
                    <form action="/search" method="GET" class="form-inline m-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <input type="text" name="searchInput">
                            </div>
                            <select class="custom-select" name="isTagSearch">
                                <option  value="0" selected>По тесту</option>
                                <option  value="1">По тегу</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">Поиск</button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>

