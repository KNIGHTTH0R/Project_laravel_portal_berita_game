<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/jquery.dataTables.css" rel="stylesheet">
    <link href="/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
 

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<style>
    .navbar.navbar-default {
background-color: black;
background-color: rgba(10,10,10,0.6 );
}
</style>

<body style="background: url({{asset('bf4.jpg')}}); 
             background-repeat: no-repeat;
             background-size: cover; 
             background-attachment: fixed;">
    <div id="app">
        <nav class="navbar navbar-default navbar.navbar-default">
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
                    @if(Auth::guest())
                    <a class="navbar-brand" href="{{ url('/guest/home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    @endif
                    @role('admin')
                    <a class="navbar-brand" href="{{ url('/admin/beritas/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    @endrole
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                       @if (Auth::check())
                        
                        <li> <a href="{{ url('/home') }}"> <i class="fa fa-btn fa-desktop"></i> Dashboard</a> </li>

                        @endif
                        @if(Auth::guest())
                             <li><a href="{{ url('/categori') }}">
                                <i class="fa fa-btn fa-folder-open"></i> Categori</a></li>
                                <li> <a href="{{ url('/home') }}"> <i class="fa fa-btn fa-desktop"></i> Dashboard</a> </li>
                        @endif
                     @role('admin')
                          <li> <a href="{{route('categoris.index')}}"> 
                            <i class="fa fa-btn fa-pencil"></i> Categori </a> </li>
                          <li> <a href="{{route('beritas.index')}}">
                            <i class="fa fa-btn fa-address-book"></i> Berita </a> </li>
                     @endrole
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">
                                <i class="fa fa-btn fa-sign-in"></i> Login</a></li>
                            <li><a href="{{ url('/register') }}">
                                <i class="fa fa-btn fa-user-plus"></i> Daftar</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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
        @include('layouts._flash')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap.min.js"></script>
    @yield('script')
</body>
</html>
