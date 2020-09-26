<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom box-shadow">
        <a class="navbar-brand" href="/">TestHub</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar nav ml-auto">
                @if (Request::is('/'))
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-success mr-3" href="/new">Создать тест</a>
                </li>
                @endif
                <li class="nav-item mr-3">
                    <a class="nav-link btn btn-outline-primary">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary">Войти с паролем</a>
                </li>
            </ul>
            <form action="search/" method="GET" class="form-inline ml-2 mt-2 mt-md-0 "><input
                    class="form-control mr-sm-2" type="text" placeholder="Найти тест" aria-label="Search"
                    name="testTitle">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Поиск</button>
            </form>
        </div>

    </nav>

</header>

