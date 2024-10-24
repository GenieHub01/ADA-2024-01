@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>

    <!-- Menu (Actions) -->
    <div class="mb-3">
        <a href="{{ route('user.create') }}" class="btn btn-success">Create User</a>
        <a href="{{ route('user.admin') }}" class="btn btn-secondary">Manage Users</a>
    </div>

    <!-- List of Users -->
    <h1>Users</h1>

    @if($users->count())
        <div class="list-group">
            @foreach($users as $user)
                @include('user._view', ['user' => $user])
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    @else
        <p>No users found.</p>
    @endif
</div>
@endsection
