@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card-panel">
        <form role="form" method="POST" action="{{ url('/register') }}">
          {{ csrf_field() }}

          <div class="input-field{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">{{ trans('auth.name') }}</label>
            <input id="name" type="text" class="validate" name="name" value="{{ old('name') }}">
              @if ($errors->has('name'))
                <span>
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
          </div>

          <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">{{ trans('auth.email') }}</label>
            <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}">
              @if ($errors->has('email'))
                <span>
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
          </div>

          <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">{{ trans('auth.password') }}</label>
            <input id="password" type="password" class="validate" name="password">
              @if ($errors->has('password'))
                <span>
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
          </div>

          <div class="input-field{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm">{{ trans('auth.pass_confirm') }}</label>
            <input id="password-confirm" type="password" class="validate" name="password_confirmation">
              @if ($errors->has('password_confirmation'))
                <span>
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
              @endif
          </div>

          <button type="submit" class="btn-large waves-effect waves-light">
            <i class="material-icons left">perm_identity</i> {{ trans('auth.session') }}
          </button>

        </form>

      </div>
    </div>
  </div>
</div>
@endsection
