@extends('layouts.app')

@section('content')
<div class="col-md-12 company-list">

    <h3>Advert List</h3>

    <a href="{{ route('advert.create') }}" class="btn btn-success">Create</a>
    <a href="{{ route('advert.index', ['paid' => 1, 'active' => 1]) }}" class="btn btn-success">Active</a>
    <a href="{{ route('advert.index', ['paid' => 0]) }}" class="btn btn-success">Not Paid</a>
    <a href="{{ route('advert.index', ['active' => 0]) }}" class="btn btn-success">Not Active</a>

    <table class="table table-bordered" id="advert-grid">
        <thead>
            <tr>
                <th>Actions</th>
                <th>Active</th>
                <th>Package</th>
                <th>Paid</th>
                <th>Expiry Date</th>
                <th>Name</th>
                <th>Address</th>
                <th>Postcode</th>
                <th>Telephone</th>
                <th>Fax</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($adverts as $advert)
                <tr>
                    <td>
                        <a href="{{ route('advert.view', $advert->id) }}" class="btn btn-sm btn-primary">View</a>
                        <a href="{{ route('advert.edit', $advert->id) }}" class="btn btn-sm btn-warning">Update</a>
                        <form action="{{ route('advert.delete', $advert->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                    <td>{{ $advert->active ? 'Yes' : 'No' }}</td>
                    <td>{{ $advert->getPackage() }}</td>
                    <td>
                        @if ($advert->paid)
                            Paid
                        @else
                            <a href="{{ route('advert.purchase', $advert->id) }}">Pay</a>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($advert->expiry_date)->format('d-m-Y') }}</td>
                    <td>{{ $advert->name }}</td>
                    <td>{{ $advert->address }}</td>
                    <td>{{ $advert->postcode }}</td>
                    <td>{{ $advert->telephone }}</td>
                    <td>{{ $advert->fax }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No adverts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
