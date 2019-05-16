<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Blog O') }}</title>--}}
    <title>@yield('title','Master Page')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('frontEnd/css/font-awesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('easyzoom/css/easyzoom.css')}}" />

    @yield('cssblock')

</head>
<body>
<div id="app">
    {{--<i class="fa fa-shopping-cart" style='font-size:36px'></i>--}}
    @include('frontEnd.layouts.header')

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ 'E-Commerce O' }}
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-home"> Home</i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-bars"> Products</i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/viewcart')}}"><i class="fa fa-shopping-cart">
                                Cart
                                <?php
                                use App\Cart_model;use Illuminate\Support\Facades\Session;
                                $session_id = Session::get('session_id');
                                if(empty($session_id)){
                                    echo '(0)';
                                }else{
                                    $productCount = Cart_model::where([
                                        'session_id' => $session_id
                                    ])->count();
                                    echo '('.$productCount.')';
                                }
                                ?></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/myaccount')}}"><i class="fa fa-user"> My Account</i></a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login-page') }}"><i class="fa fa-lock">{{ __(' Login') }}</i></a>
                        </li>
                        {{--@if (Route::has('register'))--}}
                        {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        {{--</li>--}}
                        {{--@endif--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-unlock"><b> {{ Auth::user()->name }}</b></i> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->isAdmin())
                                    <a class="dropdown-item" href="{{ url('/admin') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ url('/logout') }}">
                                    {{ __('Logout') }}
                                </a>
                            </div>

                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container-fluid">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </main>

</div>

@include('frontEnd.layouts.footer')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('frontEnd/js/jquery.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#filterForm").on("change", "input:checkbox,input:radio", function(){
            $("#filterForm").submit();
        });
    });
</script>
@yield('jsblock')

</body>
</html>
