@extends('layouts.app')

@section('content')
    <div class="col-md-12 form-theme">
        <h3>{{ 'Login' }}</h3>

        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" name="rememberMe" id="rememberMe" class="form-check-input">
                <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-primary login-submit">Login</button>

            <br>
            <a href="{{ route('password.restore.form') }}" class="login-forgot">Forgot your password?</a>

            <!-- Include the Login Social Widget -->
            @include('components.login-social')
        </form>
    </div>
@endsection
