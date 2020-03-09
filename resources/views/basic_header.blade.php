<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
<h1 class="my-0 mr-md-auto font-weight-normal">TestHub</h1>
    <ul class="list-group list-group-horizontal" style="list-style: none;">
        <li>
            <a class="btn btn-outline-primary mr-2" href="#">Регистрация</a>
        </li>

        <li>
            <a class="btn btn-outline-primary" href="#">Войти с паролем</a>
        </li>

        <li>
            <form class="form-inline ml-2 mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Поиск" aria-label="Search">
                @csrf
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Поиск</button>
            </form>
        </li>

    </ul>

</header>
