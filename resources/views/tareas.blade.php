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
            <form action="{{ url('crear') }}" method="post">
              {{ csrf_field() }}
              <div class="input-field">
                <input type="text" name="texto" placeholder="{{ trans('messages.escribir_tarea') }}">
                <span class="input-group-btn">
                  <input type="submit" value="{{ trans('messages.guardar_tarea') }}" class="waves-effect btn btn-accent-color">
                </span>
              </div>
            </form>
          </div>
        </div>
        <div class="col s12 l8">
          <div class="animated fadeInUp">
            <table class="responsive-table highlight">
              @if(count($tareas) > 0)
                <tr>
                  <th>{{ trans('messages.tareas') }}</th>
                  <th>{{ trans('messages.estado') }}</th>
                  <th>{{ trans('messages.fecha_creada') }}</th>
                  <th class="right-align">{{ trans('messages.acciones') }}</th>
                </tr>
              @endif

              @forelse($tareas as $tarea)
                @if($tarea->estado === 'Completada')
                  <tr class="tr-color-light">
                @else
                  <tr>
                @endif
                  <td>{{ $tarea->texto }}</td>
                  <td>{{ $tarea->estado }}</td>
                  <td>{{ $tarea->created_at }}</td>
                  <td class="right-align">
                    @if($tarea->estado == 'Pendiente')
                      <a href="{{ url('completar', [$tarea->id]) }}" class="waves-effect btn btn-accent-color" title="{{ trans('messages.completar') }}">
                        <i class="material-icons">done</i>
                      </a>
                    @endif
                    <a href="{{ url('borrar', [$tarea->id]) }}" class="waves-effect red darken-1 btn" title="{{ trans('messages.eliminar_tarea') }}">
                      <i class="material-icons">delete</i>
                    </a>
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
