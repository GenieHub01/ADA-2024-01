@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login</h2>

    <!-- Form login sosial -->
    <a href="{{ route('auth.google') }}" class="btn btn-danger btn-block">
        <i class="fab fa-google"></i> Login with Google
    </a>

    <!-- Anda bisa tambahkan penyedia lain jika diperlukan -->
</div>
@endsection
