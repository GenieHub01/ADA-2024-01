@extends('layouts.app')

@section('content')
<div class="col-md-12 form-theme">
    <h3>View Paylog #{{ $paylog->id }}</h3>

    <ul class="breadcrumb">
        <li><a href="{{ route('paylogs.index') }}">Paylogs</a></li>
        <li>{{ $paylog->id }}</li>
    </ul>

    <div class="menu">
        <a href="{{ route('paylogs.index') }}">List Paylog</a> |
        <a href="{{ route('paylogs.create') }}">Create Paylog</a> |
        <a href="{{ route('paylogs.edit', $paylog->id) }}">Update Paylog</a> |
        <form action="{{ route('paylogs.destroy', $paylog->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')">Delete Paylog</button>
        </form> |
        <a href="{{ route('paylogs.admin') }}">Manage Paylog</a>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $paylog->id }}</td>
        </tr>
        <tr>
            <th>User ID</th>
            <td>{{ $paylog->user_id }}</td>
        </tr>
        <tr>
            <th>Advert ID</th>
            <td>{{ $paylog->advert_id }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td>{{ $paylog->amount }}</td>
        </tr>
        <tr>
            <th>Create Time</th>
            <td>{{ $paylog->create_time }}</td>
        </tr>
    </table>
</div>
@endsection
