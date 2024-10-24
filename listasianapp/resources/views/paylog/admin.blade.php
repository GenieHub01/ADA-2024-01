@extends('layouts.app')

@section('content')
<div class="col-md-12 company-list">
    <h3>Payments</h3>

    <ul class="breadcrumb">
        <li><a href="{{ route('paylogs.index') }}">Paylogs</a></li>
    </ul>

    <div class="menu">
        <a href="{{ route('paylogs.index') }}">List Paylog</a> |
        <a href="{{ route('paylogs.admin') }}">Manage Paylogs</a> |
        <a href="{{ route('paylogs.show', $paylog->id) }}">View Paylog</a>
    </div>

    <table class="table table-bordered" id="paylog-grid">
        <thead>
            <tr>
                <th>User Email</th>
                <th>Advert ID</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Create Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paylogs as $paylog)
                <tr>
                    <td>
                        {{ $paylog->user->email }}
                    </td>
                    <td>{{ $paylog->advert_id }}</td>
                    <td>{{ $paylog->amount }}</td>
                    <td>{{ $paylog->description }}</td>
                    <td>{{ \Illuminate\Support\Facades\Date::parse($paylog->create_time)->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <a href="{{ route('paylogs.show', $paylog->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('paylogs.edit', $paylog->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('paylogs.destroy', $paylog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Optional pagination --}}
    {{ $paylogs->links() }}
</div>
@endsection
