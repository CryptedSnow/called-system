<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title> @yield('title') </title>

    <style>
        .required {
          color: red;
        }
    </style>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('select2/select2.css') }}">
    <script type="text/javascript" src="{{ asset('sweetalert2/sweetalert2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('fontawesome/41b4cd8ba8.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery/jquery-3.2.1.slim.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('jquery/pooper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('select2/select2.js') }}"></script>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Alert status -->
                @include('components.alert-component')

                <script>
                    $(document).ready(function() {
                        $('.js-example-basic-multiple').select2();
                    });
                </script>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            {{-- @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else

                        {{-- <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('empresa') }}">{{ __('Empresa') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('chamado') }}">{{ __('Chamado') }}</a>
                            </li>
                        </ul> --}}

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Str::words(Auth::user()->name, 1, '') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url("empresa") }}">
                                    <i class="fa-regular fa-building"></i>&nbsp;{{ __('Empresa') }}
                                </a>

                                <a class="dropdown-item" href="{{ url("chamado") }}">
                                    <i class="fa-solid fa-headset"></i>&nbsp;{{ __('Chamado') }}
                                </a>

                                <a class="dropdown-item" href="{{ url("log-viewer") }}" target="_blank">
                                    <i class="fa-solid fa-circle-info"></i>&nbsp;{{ __('Logs') }}
                                </a>

                                @role("Admin")
                                    <a class="dropdown-item" href="{{ url('user') }}">
                                        <i class="fa-regular fa-circle-user"></i>&nbsp;{{ __('Usuário') }}
                                    </a>
                                @endrole

                                @role("Admin")
                                    <a class="dropdown-item" href="{{ url("role") }}">
                                        <i class="fa-solid fa-user-check"></i></i>&nbsp;{{ __('Regra') }}
                                    </a>
                                @endrole

                                @role("Admin")
                                    <a class="dropdown-item" href="{{ url('permission') }}">
                                        <i class="fa-regular fa-circle-check"></i>&nbsp;{{ __('Permissão') }}
                                    </a>
                                @endrole

                                <a class="dropdown-item" href="{{ url("profile") }}">
                                    <i class="fa-solid fa-gear"></i>&nbsp;{{ __('Configurações') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-right-from-bracket"></i>&nbsp;{{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
