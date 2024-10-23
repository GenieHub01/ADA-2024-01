@extends('layouts.app')

@section('content')
<div class="col-md-12 company-list">

    <h3>Subscriptions</h3>

    <a href="{{ route('plans.create') }}" class="btn btn-success">Create</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Package</th>
                <th>Interval</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($model->search() as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ \App\Models\Price::find($item->package)->name ?? 'N/A' }}</td>
                    <td>{{ $item->intervalList[$item->interval] ?? 'N/A' }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->currency }}</td>
                    <td>
                        <a href="{{ route('plans.edit', $item->id) }}" class="btn btn-primary">Update</a>
                        <form action="{{ route('plans.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
