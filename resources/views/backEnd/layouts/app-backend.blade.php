<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Blog O') }}</title>--}}
    <title>@yield('title','Master Page')</title>

    {{--<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />--}}
    {{--<link rel="stylesheet" href="{{asset('css/bootstrap-responsive.min.css')}}" />--}}
    {{--<link rel="stylesheet" href="{{asset('css/colorpicker.css')}}" />--}}
    {{--<link rel="stylesheet" href="{{ asset('css/uniform.css') }}" />--}}
    {{--<link rel="stylesheet" href="{{ asset('css/select2.css') }}" />--}}
    {{--<link rel="stylesheet" href="{{asset('css/fullcalendar.css')}}" />--}}
    {{--<link rel="stylesheet" href="{{asset('css/matrix-style.css')}}" />--}}
    {{--<link rel="stylesheet" href="{{asset('css/matrix-media.css')}}" />--}}
    {{--<link rel="stylesheet" href="{{asset('css/bootstrap-wysihtml5.css')}}" />--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">--}}
    {{--<link href="{{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet" />--}}
    {{--<link rel="stylesheet" href="{{asset('css/jquery.gritter.css')}}" />--}}
    {{--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>--}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    {{--@yield('scripts')--}}

    {{--<script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>--}}
    {{--<script>--}}
        {{--tinymce.init({--}}
            {{--// selector:'textarea',--}}
            {{--mode : "specific_textareas",--}}
            {{--editor_selector : "mceEditor"--}}
            {{--// branding: false,--}}
            {{--// plugins: "link code"--}}
        {{--});--}}
    {{--</script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
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
                    @guest
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="https://www.google.com">Google</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="https://laravel.com/docs/5.8/">Laravel</a>--}}
                        {{--</li>--}}
                    @else
                        {{--<li class="nav-item ml-4">--}}
                            {{--<span class="nav-link">--}}
                                {{--@yield('breadcrumb-side')--}}
                            {{--</span>--}}
                        {{--</li>--}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/admin/')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/admin/settings')}}">Settings</a>
                        </li>
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="{{url('/admin/categories')}}">Products</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="{{url('/admin/comments')}}">Coupons</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="{{url('/admin/contact')}}">Orders</a>--}}
                        {{--</li>--}}
                    @endguest
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                        </li>
                        {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                        {{--</li>--}}
                        {{--@if (Route::has('register'))--}}
                        {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                        {{--</li>--}}
                        {{--@endif--}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
        <div class="container">
            <div class="row">
                @include('backEnd.layouts.nav')
                @yield('content')
            </div>
        </div>
    </main>

</div>

@include('backEnd.layouts.footer')

@yield('jsblock')

</body>
</html>
