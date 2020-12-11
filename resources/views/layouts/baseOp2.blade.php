<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Proyecto Web') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-colorPrimario">
            <a class="navbar-brand" href="{{ url('/') }}">Proyecto Web</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavDropdown">
                <!-- Right Side Of Navbar (Responsive)-->
                <ul class="navbar-nav md-ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->nombre }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                <!-- Center Side Of Navbar (Responsive)-->
                <ul class="navbar-nav mr-auto"></ul>

                <!-- Left Side Of Navbar (Responsive)-->
                @auth
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/crearNuevoAlmacen">Crear Almacén</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ver Receta X</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Almacenes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Mis almacenes</a>
                            <a class="dropdown-item" href="/crearNuevoAlmacen">Crear nuevo almacén</a>
                        </div>
                    </li>
                    <!-- NOTA: Barra de busqueda sin implementar -->
                    <!-- <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form> -->
                </ul>
                @endauth
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <div class="mt-auto" style="height: 100px;"><!-- Espaciado --></div>

    <!-- Scripts -->
    <!-- Por defecto -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- JQuery minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</body>
</html>
