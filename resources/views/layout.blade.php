<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <header>
        <?php function activeMenu($url) {
            return request()->is($url) ? 'active' : '';
        } ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ activeMenu('/') }}">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item {{ activeMenu('messages/create') }}">
                            <a class="nav-link" href="{{ route('messages.create') }}">Contactos</a>
                        </li>
                        @if (auth()->check())
                            <li class="nav-item {{ activeMenu('messages*') }}">
                                <a class="nav-link" href="{{ route('messages.index') }}">Mensajes</a>
                            </li>
                            @if (auth()->user()->hasRole(['admin']))
                                <li class="nav-item {{ activeMenu('users*') }}">
                                    <a class="nav-link" href="{{ route('users.index') }}">Usuarios</a>
                                </li>
                            @endif
                        @endif


                    </ul>
                    <ul class="navbar-nav navbar-right">
                        @if (auth()->guest())
                            <li class="nav-item {{ activeMenu('login') }}">
                                    <a class="nav-link" href="/login">Login</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    {{ auth()->user()->name }}
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id) }}">Mi cuenta</a>
                                    <a class="dropdown-item" href="/logout">Cerrar sesión</a>
                                </div>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">

        @yield('content')

        <footer>
            <hr>
            APP chida 2018
        </footer>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>