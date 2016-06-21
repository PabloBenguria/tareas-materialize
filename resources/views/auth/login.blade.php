@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col s12">
        <div class="card-panel">

          <form role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

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

            <button type="submit" class="btn waves-effect waves-light">{{ trans('auth.session') }}</button>
            <a class="btn waves-effect waves-light" href="{{ url('/password/reset') }}">{{ trans('auth.forgot_pass') }}</a>

          </form>

        </div>
      </div>
    </div>
  </div>
@endsection
