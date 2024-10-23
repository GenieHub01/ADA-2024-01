@extends('layouts.app')

@section('content')
    <h1>Cities</h1>
    <ul>
        @foreach ($data as $id => $name)
            <li>{{ $name }}</li>
        @endforeach
    </ul>
@endsection
