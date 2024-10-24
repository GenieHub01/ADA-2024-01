@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->getName() }}</li>
        </ol>
    </nav>

    <!-- User Information -->
    <h3>User {{ $user->getName() }}</h3>

    <table class="table table-striped">
        <tr>
            <th>First Name</th>
            <td>{{ $user->f_name }}</td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td>{{ $user->l_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Expiry Date</th>
            <td>{{ \Carbon\Carbon::parse($user->expiry)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>
                <a href="tel:{{ $user->phone }}" rel="nofollow">{{ $user->phone }}</a>
            </td>
        </tr>
        <tr>
            <th>Notes</th>
            <td>{!! nl2br(e($user->notes)) !!}</td>
        </tr>
    </table>
</div>
@endsection
