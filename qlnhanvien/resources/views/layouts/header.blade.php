<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quan ly nhân viên</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
				      <a class="navbar-brand" href="{{route('home')}}">HOME</a>
				    </div>
				     <div class="collapse navbar-collapse" id="myNavbar">
				      <ul class="nav navbar-nav navbar-right">
				        <li class="dropdown">
				          	 <a class="dropdown-toggle" data-toggle="dropdown" href="#">HI, {{ Auth::user()->username }}
				          <span class="caret"></span></a>
				          <ul class="dropdown-menu">
				            <li><a class="dropdown-item" href="{{ route('changepass') }}">
                                        Đổi mật khẩu
                                </a>
                            </li>
				            <li>
				            	<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                </form>
				            </li>
				          </ul>
				        </li>
				      </ul>
				    </div>
				</nav>
    </div>
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
