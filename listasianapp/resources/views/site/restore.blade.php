@extends('layouts.app')

@section('content')
    <h1>{{ 'Restore Password' }}</h1>

    @if (session('message'))
        <h3>{{ session('message') }}</h3>
    @else
        <div class="col-md-12 form-theme">
            <h3>Restore Password</h3>

            <form id="form" method="POST" action="{{ route('password.restore') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Restore</button>
            </form>
        </div>
    @endif
@endsection
