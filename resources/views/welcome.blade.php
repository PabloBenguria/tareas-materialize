@extends('layouts.app')

@section('content')
<div class="content-welcome">
  <div class="container">
    @if(Auth::guest())
      <h1 class="header center">{{ trans('messages.bienvenido') }}</h1>
    @else
      <h1 class="header center btn-user">{{ trans('messages.bienvenido') }}, {{ Auth::user()->name }}</h1>
    @endif
    <div class="row center">
      <h5 class="header col s12 light">{{ trans('messages.gestion_tareas') }}</h5>
    </div>
    <div class="row center">
      @if(Auth::guest())
        <a href="{{ url('/login') }}" class="btn-large waves-effect waves-light">{{ trans('auth.session') }}</a>
      @else
        <a href="{{ url('/tareas') }}" class="btn-large waves-effect waves-light">{{ trans('messages.ver_tareas') }}</a>
      @endif
    </div>
  </div>
</div>
<div class="container">
  @if(Auth::guest())
    <div class="section-welcome">
      <div class="row">
        <div class="col s12 m4 animated fadeInUp">
          <div class="icon-block">
            <h2 class="center animated pulse infinite"><i class="large material-icons">comment</i></h2>
            <h5 class="center">{{ trans('messages.creacion_tarea') }}</h5>
            <p class="light">{{ trans('messages.title1') }}</p>
          </div>
        </div>
        <div class="col s12 m4 animated fadeInUp">
          <div class="icon-block">
            <h2 class="center animated pulse infinite"><i class="large material-icons">view_list</i></h2>
            <h5 class="center">{{ trans('messages.filtrar_tareas') }}</h5>
            <p class="light">{{ trans('messages.title2') }}</p>
          </div>
        </div>
        <div class="col s12 m4 animated fadeInUp">
          <div class="icon-block">
            <h2 class="center animated pulse infinite"><i class="large material-icons">settings</i></h2>
            <h5 class="center">{{ trans('messages.config_tareas') }}</h5>
            <p class="light">{{ trans('messages.title3') }}</p>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection
