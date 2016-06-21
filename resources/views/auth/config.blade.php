@extends('layouts.app')

@section('title')
{{ trans('auth.title') }}
@endsection

@section('contenido')
<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h2>{{ trans('auth.config_session') }}</h2>
          <div class="panel panel-default">
              <div class="panel-heading">{{ trans('auth.pass_change') }}</div>
              <div class="panel-body">
                <form class="form-horizontal" action="{{ url('cambiar-pass') }}" method="post">
                  <div class="form-group">
                    <label for="passActual" class="col-sm-3 control-label">{{ trans('auth.pass_current') }}</label>
                    <div class="col-sm-9">
                      <input type="password" name="passActual" class="form-control">
                    </div>
                  </div>
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="pass1" class="col-sm-3 control-label">{{ trans('auth.pass_new') }}</label>
                    <div class="col-sm-9">
                      <input type="password" name="pass1" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pass2" class="col-sm-3 control-label">{{ trans('auth.pass_confirm') }}</label>
                    <div class="col-sm-9">
                      <input type="password" name="pass2" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                      <input type="submit" class="btn btn-success" value="{{ trans('auth.save_changes') }}">
                    </div>
                  </div>
                </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
