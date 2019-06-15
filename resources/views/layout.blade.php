<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>@yield('title',('Hatweet'))</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/User.css">
    <link rel="stylesheet" href="/css/edit.css">
    <link rel="icon" type="image/png" href="/image/icone.png" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="backcolor">

    <div id="app " >
        <nav class="navbar navbar-expand-md navbar-light border-danger navbar-fixed-top container-fluid " >
                <a class=" offset-xm-1 offset-lg-1 offset-sm-0 navbar-brand" href="{{route('home')}}" style="position: relative; bottom: 6px;">
                    <img src="/image/icone.png" width="40" height="30" class=" d-inline-block " alt="" >
                    Hatweet
                </a>


            <!-- Left Side Of Navbar -->
            <ul class=" offset-lg-6 offset-sm-4 offset-xm-8" >
                @if(Auth::check())
                    <a href="{{route("profile.show",Auth::user()->id)}}" class=" mr-3  ">
                        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" width="32px" height="32px" class="rounded-circle ">

                    </a>
                @endif

            </ul>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse " id="navbarTogglerDemo02">
                    <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>

                                @endif
                            @else
                                    <a >
                                   <!--   id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre-->
                                {{ Auth::user()->name }}
                                </a>
                                <li class="nav-item dropdown"  >
                                    <div> <!--class="dropdown-menu dropdown-menu-right"> aria-labelledby="navbarDropdown">-->
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <a class="dropdown-item" href="{{route('profile.show',Auth::user()->id)}}">{{ __('Profile') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>

                </nav>
            <div class="container ">
                @yield('content')
            </div>
        </div>
    </body>
</html>
