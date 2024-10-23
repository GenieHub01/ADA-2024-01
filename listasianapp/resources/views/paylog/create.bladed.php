@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <h1>Create Paylog</h1>

    <ul class="breadcrumb">
        <li><a href="{{ route('paylogs.index') }}">Paylogs</a></li>
        <li>Create</li>
    </ul>

    <div class="menu">
        <a href="{{ route('paylogs.index') }}">List Paylog</a> |
        <a href="{{ route('paylogs.admin') }}">Manage Paylog</a>
    </div>

    @include('paylog._form', ['paylog' => $paylog])
</div>
@endsection
