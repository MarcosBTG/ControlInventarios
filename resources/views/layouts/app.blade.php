<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--<title>{{ config('app.name', 'Laravel') }}</title>-->
        <title>S.C.Inventario</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style> 
            .texto{
                color: #FFF;
                padding: 0px;
            }
            .texto:hover{
                transition: .3s;
                font-size: 15px; 
                color: #FFF;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top" style="background-color: #339cff;">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                                                <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
<!--                            <img src="{{ asset('img/m.jpg') }}" width="30" height="30" class="d-inline-block align-top" alt="">-->
                            <span class="mb-0 h3">S.C.Inventario</span>
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                            @if (!Auth::guest())
                        <ul class="nav navbar-nav">
                            @if(route('products.catalogue'))
                                <li class="active"><a href="{{ url('/products/index')}}">Productos</a></li>
                                <li><a href="{{ url('/containers/index')}}"><h5 class="texto">Contenedores</h5></a></li>
                            @else
                                <li class="active"><a href="{{ url('/containers/index')}}"><h5>Contenedores</h5></a></li>
                                <li><a href="{{ url('/products/index')}}"><h5 class="texto">Productos</h5></a></li>
                            @endif
                        </ul>
                            @endif
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Iniciar sesi&oacute;n</a></li>
                            <li><a href="{{ route('register') }}">Registro</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li> 
                                        <a href="{{ url('/products/index')}}">
                                            Productos
                                        </a>
                                    </li>
                                    <li> 
                                        <a href="{{ route('containers.catalogue')}}">
                                            Contenedores
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            Cerrar sesi&oacute;n
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>
        @yield('javascript')
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
