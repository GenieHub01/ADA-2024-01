@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update {{ $user->getName() }}</li>
        </ol>
    </nav>

    <!-- User Update Form -->
    <div class="col-md-12 form-theme">
        <h3>User {{ $user->getName() }}</h3>

        <!-- Include the form partial -->
        @include('user._form', ['user' => $user])
    </div>
</div>
@endsection
