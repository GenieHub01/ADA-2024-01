@extends('layouts.app')

@section('content')
<div class="col-md-12 company-list">
    <h3>Payments</h3>

    <table class="table table-bordered" id="paylog-grid">
        <thead>
            <tr>
                <th>Advert ID</th>
                <th>Amount</th>
                <th>Description</th>
                <th>Create Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paylogs as $paylog)
                <tr>
                    <td>
                        <a href="{{ route('advert.view', $paylog->advert_id) }}">
                            {{ $paylog->advert_id }}
                        </a>
                    </td>
                    <td>{{ $paylog->amount }}</td>
                    <td>{{ $paylog->description }}</td>
                    <td>{{ \Illuminate\Support\Facades\Date::parse($paylog->create_time)->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $paylogs->links() }}
</div>
@endsection
