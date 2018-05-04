@extends('layouts.app')

@section('content')
    <article class="container-login d-flex justify-content-center align-items-center">
        <form class="d-flex flex-column justify-content-center container-form-admin " method="POST" action="{{ route('change') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <h5 class="title-logo">qikify</h5>
            </div>
            <div class="form-group">
              <label for="newPassword">New Password</label>
              <input type="password" class="form-control input-config input-width" id="newPassword" placeholder="New Password" name="new" required>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
              <label for="configPassword">Config New Password</label>
              <input type="password" class="form-control input-config input-width" id="configPassword" placeholder="Config New Password" name="config" required>
                @if(session()->has('error_config'))
                 <small id="emailHelp" class="form-text text-muted">{!! session('error_config') !!}</small>
                @endif
            </div>
            <button type="submit" class="btn btn-outline-primary border-hidden">Submit</button>
          </form>
    </article>
@endsection
