<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/d0de32b055.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>





<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name }}
                            </a>


                            @can('isAdmin')
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">



                            <a class="dropdown-item" href="{{ route('products') }}">
                                    {{ __('products') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('ShopAdmin') }}">
                                    {{ __('عرض المتاجر') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('reviews') }}">
                                    {{ __('Reviews') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('state') }}">
                                    {{ __('States') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('countries') }}">
                                    {{ __('Countries') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('tickets') }}">
                                    {{ __('Tickets') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('roles') }}">
                                    {{ __('Roles') }}
                                </a>


                                <a class="dropdown-item" href="{{ route('cities') }}">
                                    {{ __('Cities') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('tags') }}">
                                    {{ __('Tags') }}
                                </a>


                                <a class="dropdown-item" href="{{ route('units') }}">
                                    {{ __('units') }}
                                </a>


                                <a class="dropdown-item" href="{{ route('categories') }}">
                                    {{ __('categories') }}
                                </a>


                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            @endcan

                            @can('isSupport')
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                                <a class="dropdown-item" href="{{ route('Shop') }}">
                                    {{ __('اضافة بيانات المتجر') }}
                                </a>




                                <a class="dropdown-item" href="{{ route('Shop_Cart') }}">
                                    {{ __('اضافة صور تراخيص المحل') }}
                                </a>

                                <a class="dropdown-item" href="{{ route('productsShop') }}">
                                    {{ __('اضافة المنتجات وادارتهاء') }}
                                </a>




                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('تسجيل الخروج') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            @endcan





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
