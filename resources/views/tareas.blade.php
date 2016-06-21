@extends('layouts.app')

@section('titulo')
{{ trans('message.inicio') }}
@endsection

@section('content')
  <div class="content-tareas">
    <div class="container">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col s12 l4">

          {!! Form::model(Request::only('estado'), ['route' => 'tareas.filter.home', 'method' => 'GET']) !!}
          <div class="card-panel hoverable filter-sidebar">
            <div class="input-field">
              {!! Form::select('estado', config('options.types'), null) !!}
            </div>
            <div class="clearfix"></div>
            <p>&nbsp;</p>
            {!! Form::submit('Filtrar', ['class' => 'waves-effect btn btn-accent-color']) !!}
            {!! Form::close() !!}
            <p>&nbsp;</p>

            {!! Form::open(array('url' => 'crear', 'method' => 'post')) !!}
              <div class="input-field">
                {!! Form::text('texto', null, array('required', 'placeholder' => 'Crear tarea')) !!}
                {!! Form::submit('Guardar tarea', ['class' => 'waves-effect btn btn-accent-color']) !!}
              </div>
            {!! Form::close() !!}

          </div>
        </div>
        <div class="col s12 l8">
          <div class="animated fadeInUp">
            <table class="responsive-table highlight">
              @if(count($tareas) > 0)
                <tr>
                  <th>{{ trans('messages.autor') }}</th>
                  <th>{{ trans('messages.estado') }}</th>
                  <th>{{ trans('messages.tareas') }}</th>
                  <th class="right-align">{{ trans('messages.acciones') }}</th>
                </tr>
              @endif

              @forelse($tareas as $tarea)
                @if($tarea->estado === 'Completada')
                  <tr class="tr-color-light">
                @else
                  <tr>
                @endif
                  <td>
                    @if($tarea->user_id === Auth::user()->id)
                      <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Autor"><i class="material-icons">perm_identity</i></a>
                    @else
                      <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Compartida"><i class="material-icons">people</i></a>
                    @endif
                  </td>
                  <td>
                    @if($tarea->estado === 'Pendiente')
                      <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Pendiente"><i class="material-icons">alarm</i></a>
                    @else
                      <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="Completada"><i class="material-icons">done</i></a>
                    @endif
                  </td>
                  <td>
                      @if($tarea->user_id === Auth::user()->id)
                        <ul class="collapsible" data-collapsible="accordion">
                          <li>
                            <div class="collapsible-header">
                              <a href="#" data-toggle="collapse">
                                  {{ $tarea->texto }}
                              </a>
                            </div>
                            <div class="collapsible-body">
                              <form action="{{ url('compartir') }}" method="post">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="tarea_id" value="{{ $tarea->id }}">
                                  <div class="input-field">
                                      <input type="email" name="email" class="validate" placeholder="Escribe el email del destinatario">
                                      <span>
                                          <input type="submit" class="btn waves-effect waves-light" value="Compartir">
                                      </span>
                                  </div>
                              </form>
                            </div>
                          </li>
                        </ul>
                      @else
                          {{ $tarea->texto }}
                      @endif
                  </td>
                  <td class="right-align">
                      @if($tarea->user_id === Auth::user()->id)
                          @if($tarea->estado === 'Pendiente')
                            <a href="{{ url('completar', [$tarea->id]) }}" class="waves-effect btn btn-accent-color" title="{{ trans('messages.completar') }}">
                              <i class="material-icons">done</i>
                            </a>
                          @endif
                            <a href="{{ url('borrar', [$tarea->id]) }}" class="waves-effect red darken-1 btn" title="{{ trans('messages.eliminar_tarea') }}">
                              <i class="material-icons">delete</i>
                            </a>
                      @else
                          @if($tarea->estado === 'Pendiente')
                            <a href="{{ url('completar', [$tarea->id]) }}" class="waves-effect btn btn-accent-color" title="{{ trans('messages.completar') }}">
                              <i class="material-icons">done</i>
                            </a>
                          @endif
                          <a href="{{ url('borrar', [$tarea->id]) }}" class="waves-effect red darken-1 btn" title="{{ trans('messages.eliminar_tarea') }}">
                            <i class="material-icons">delete</i>
                          </a>
                      @endif
                  </td>
                </tr>
              @empty
                <h2>{{ trans('messages.no_tareas') }}</h2>
              @endforelse
            </table>
          </div>

          <div class="center-align">
            {!! $tareas->appends(Request::only('estado'))->render() !!}
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
