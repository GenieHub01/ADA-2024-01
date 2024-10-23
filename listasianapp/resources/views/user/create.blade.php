@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    <!-- Menu (Actions) -->
    <div class="mb-3">
        <a href="{{ route('user.admin') }}" class="btn btn-secondary">Manage Users</a>
    </div>

    <!-- User Creation Form -->
    <div class="col-md-12 form-theme">
        <h3>Create User</h3>

        <!-- Include the form partial -->
        @include('user._form', ['user' => $user])
    </div>
</div>
@endsection
