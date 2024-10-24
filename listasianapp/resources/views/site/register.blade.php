@extends('layouts.app')

@section('content')
    <h1>{{ 'Register' }}</h1>

    @if (session('message'))
        <h3>{{ session('message') }}</h3>
    @else
        <div class="col-md-12 form-theme">
            <h3>Registration</h3>

            <form id="reg-form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="f_name">First Name</label>
                    <input type="text" name="f_name" id="f_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="l_name">Last Name</label>
                    <input type="text" name="l_name" id="l_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" name="phone" id="phone" class="form-control" autocomplete="tel" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password2">Confirm Password</label>
                    <input type="password" name="password2" id="password2" class="form-control" required>
                </div>

                <!-- ReCaptcha -->
                <div class="form-group">
                    {!! recaptcha_field('recaptcha') !!}
                    @error('recaptcha')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary register-submit">Register</button>
            </form>

            <!-- Login Social Widget -->
            @include('components.login-social')
        </div>
    @endif
@endsection
