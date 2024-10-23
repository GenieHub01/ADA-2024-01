@extends('layouts.app')

@section('title', config('app.name') . ' - Error')

@section('content')
    <h2>Error {{ $code }}</h2>

    <div class="error">
        {{ $message }}
    </div>
@endsection
