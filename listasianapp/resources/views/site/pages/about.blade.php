@extends('layouts.app')

@section('title', config('app.name') . ' - About')

@section('content')
    <h1>About</h1>

    <p>
        This is a "static" page. You may change the content of this page
        by updating the file <code>{{ __FILE__ }}</code>.
    </p>
@endsection
