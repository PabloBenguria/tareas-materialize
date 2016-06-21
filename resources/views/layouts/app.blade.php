<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('titulo') - {{ trans('messages.titulo') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('css/materialize/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body id="app-layout">
    <div class="container">
      <nav>
        <div class="nav-wrapper">
          <a href="{{ url('/') }}" class="nav-logo right hide-on-large-only"><i class="material-icons">home</i></a>
          <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="hide-on-med-and-down">
            <li><a href="{{ url('/') }}" class="nav-logo" title="{{ trans('messages.inicio') }}"><i class="material-icons">home</i></a></li>
            @if(Auth::user())
              <li><a href="{{ url('/tareas') }}">{{ trans('messages.tareas') }}</a></li>
            @endif
          </ul>
          <ul class="side-nav" id="mobile-menu">
            @if (Auth::guest())
              <li><a href="{{ url('/login') }}">{{ trans('auth.session') }}</a></li>
              <li><a href="{{ url('/register') }}">{{ trans('auth.register') }}</a></li>
            @else
              <li><a href="{{ url('/tareas') }}">{{ trans('messages.tareas') }}</a></li>
              <li><a class="dropdown-button-mobile btn-user" href="#!" data-activates="dropdown3">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a>
                <ul id="dropdown3" class="dropdown-content">
                  <li><a href="{{ url('/config') }}"><i class="material-icons left">settings</i>{{ trans('auth.config') }}</a></li>
                  <li class="divider"></li>
                  <li><a href="{{ url('/logout') }}"><i class="material-icons left">input</i>{{ trans('auth.logout') }}</a></li>
                </ul>
              </li>
            @endif
            <li><a class="dropdown-button-mobile" href="#!" data-activates="dropdown4">{{ trans('messages.idioma') }} <i class="material-icons right">arrow_drop_down</i></a>
              <ul id="dropdown4" class="dropdown-content">
                  <li><a href="{{ url('idioma/es') }}">ES</a></li>
                  <li class="divider"></li>
                  <li><a href="{{ url('idioma/en') }}">EN</a></li>
              </ul>
            </li>
          </ul>
          <!-- Right Side Of Navbar -->
          <ul class="right hide-on-med-and-down">
            <!-- Authentication Links -->
            @if (Auth::guest())
              <li><a href="{{ url('/login') }}">{{ trans('auth.session') }}</a></li>
              <li><a href="{{ url('/register') }}">{{ trans('auth.register') }}</a></li>
            @else
              <li><a class="dropdown-button btn-user" href="#!" data-activates="dropdown1">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a>
                <ul id="dropdown1" class="dropdown-content">
                  <li><a href="{{ url('/config') }}"><i class="material-icons left">settings</i>{{ trans('auth.config') }}</a></li>
                  <li class="divider"></li>
                  <li><a href="{{ url('/logout') }}"><i class="material-icons left">input</i>{{ trans('auth.logout') }}</a></li>
                </ul>
              </li>
            @endif
            <li><a class="dropdown-button" href="#!" data-activates="dropdown2">{{ trans('messages.idioma') }} <i class="material-icons right">arrow_drop_down</i></a>
              <ul id="dropdown2" class="dropdown-content">
                  <li><a href="{{ url('idioma/es') }}">ES</a></li>
                  <li class="divider"></li>
                  <li><a href="{{ url('idioma/en') }}">EN</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    @if(session()->has('success'))
      <div class="content-alert">
        <div class="container">
          <div class="col s12 l4">
            <div class="alert-success">
              <button type="button" class="close"><i class="material-icons">clear</i></button>
              {{ session('success') }}
            </div>
          </div>
        </div>
      </div>
    @endif

    @if(session()->has('error'))
      <div class="container">
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{ session('error') }}
        </div>
      </div>
    @endif

    @if(count($errors) > 0)
      <div class="container">
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    @endif

    @if(session()->has('info'))
      <div class="container">
        <div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{ session('info') }}
        </div>
      </div>
    @endif

    <main>
      @yield('content')
    </main>

    <div class="container">
      <footer class="page-footer">
        <div class="footer-copyright">
          <div class="container">
           © 2016 Pablo Benguría
          </div>
        </div>
      </footer>
    </div>

  <!-- JavaScripts -->
  <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
  <script src="{{ asset('js/materialize/materialize.min.js') }}"></script>
  <script src="{{ asset('js/front.js') }}"></script>
</body>
</html>
