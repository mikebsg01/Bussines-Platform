<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'AEM')</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/barrating/fontawesome-stars.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/hover.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.tagsinput.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
  <!-- [FAVICON] -->
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/img/favicon/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/img/favicon/apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/img/favicon/apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/favicon/apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/img/favicon/apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/img/favicon/apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/img/favicon/apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/img/favicon/apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-icon-180x180.png') }}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/img/favicon/android-icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon/favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('assets/img/favicon/manifest.json') }}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('assets/img/favicon/ms-icon-144x144.png') }}">
  <meta name="theme-color" content="#ffffff">
  <!-- [END FAVICON] -->
</head>
<body class="@yield('body-classes')">
  <nav class="navbar navbar-fixed-top app-navbar">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ asset('/') }}">
          <div class="aem-logo"></div>
        </a>
      </div>
      <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
        @unless (Auth::guest() or Route::is("home"))
          {!! Form::open(['route' => 'enterprise.search','method' => 'GET', 'class' => 'navbar-form inline-block navbar-search no-padding']) !!}
            <div class="form-group navbar-search-form text-center">
              <div class="input-group search-input-group">
                {{ Form::text('q', isset($q) ? $q : "", ['class' => 'form-control text-center navbar-search-input', 'placeholder' => 'Buscar empresa, producto o servicio...']) }}
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default special-btn special-btn-red special-btn-small">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                </div>
              </div>
            </div>
          {!! Form::close() !!}
        @endunless
        <ul class="nav navbar-nav navbar-right">
          @if ( !isset($prefix) || is_null($prefix) || !preg_match('/(register)/', $prefix) )
            <li><a href="{{ url('/') }}">Inicio</a></li>
          @endif
          @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Ingresar</a></li>
            <li><a href="{{ url('/register') }}">Registrarse</a></li>
          @else
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{!! Auth::user()->short_name !!}</a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/logout') }}">Cerrar sesión <i class="glyphicon glyphicon-log-out"></i> </a></li>
            </ul>
          </li>
          @endif 
          <li><a href="#">Ayuda</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ES</a>
            <ul class="dropdown-menu">
              <li><a href="#">Español (MEX)</a></li>
              <li><a href="#">English (USA)</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div class="@yield('content-classes')" @yield('specific-height')>
    <div class="navbar-space"></div>
    @yield('content')
  </div>
  <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/chosen.jquery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/jquery.tagsinput.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/moment-with-locales.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/jquery.barrating.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/url.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/app/general.js') }}"></script>
  {!! app_js_file('assets/js/app/controllers/', Route::current()->getActionName()) !!}
</body>
</html>