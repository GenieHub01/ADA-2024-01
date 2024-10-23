@extends('layouts.app')

@section('content')
<div class="col-md-12 form-theme">
    <h3>Update Paylog #{{ $paylog->id }}</h3>

    <ul class="breadcrumb">
        <li><a href="{{ route('paylogs.index') }}">Paylogs</a></li>
        <li><a href="{{ route('paylogs.show', $paylog->id) }}">{{ $paylog->id }}</a></li>
        <li>Update</li>
    </ul>

    <div class="menu">
        <a href="{{ route('paylogs.index') }}">List Paylog</a> |
        <a href="{{ route('paylogs.create') }}">Create Paylog</a> |
        <a href="{{ route('paylogs.show', $paylog->id) }}">View Paylog</a> |
        <a href="{{ route('paylogs.admin') }}">Manage Paylog</a>
    </div>

    @include('paylog._form', ['paylog' => $paylog])
</div>
@endsection
