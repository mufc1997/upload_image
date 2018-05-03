@extends('layouts.app')

@section('content')
    <article class="container-login d-flex justify-content-center align-items-center">
        <form class="container-form d-flex flex-column justify-content-center" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <h5 class="title-logo">qikify</h5>
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control input-config input-width" id="username" value="{{ old('username') }}" aria-describedby="emailHelp" placeholder="Username" name="username" required>
              @if ($errors->has('username'))
                 <small id="emailHelp" class="form-text text-muted">{{ $errors->first('username') }}</small>
              @endif
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control input-config input-width" id="password" placeholder="Password" name="password" required>
              @if ($errors->has('password'))
                 <small id="emailHelp" class="form-text text-muted">{{ $errors->first('password') }}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-outline-primary border-hidden">Submit</button>
          </form>
    </article>
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
