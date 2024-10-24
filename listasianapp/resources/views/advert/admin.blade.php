@extends('layouts.app')

@section('content')
<div class="col-md-12 company-list">

    <h3>Manage Adverts</h3>

    <a href="{{ route('advert.create') }}" class="btn btn-success">Create</a>

    <table class="table table-bordered" id="advert-grid">
        <thead>
            <tr>
                <th>Actions</th>
                <th>ID</th>
                <th>User Email</th>
                <th>Name</th>
                <th>Manager Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>SEO1</th>
                <th>SEO2</th>
                <th>Active</th>
                <th>Paid</th>
                <th>Start Date</th>
                <th>Expiry Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($adverts as $advert)
                <tr>
                    <td>
                        <a href="{{ route('advert.edit', $advert->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('advert.delete', $advert->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>{{ $advert->id }}</td>
                    <td>{{ $advert->user->email ?? 'N/A' }}</td>
                    <td>{{ $advert->name }}</td>
                    <td>{{ $advert->manager_name }}</td>
                    <td>{{ $advert->mobile }}</td>
                    <td>{{ $advert->email }}</td>
                    <td>{{ $advert->telephone }}</td>
                    <td>{{ $advert->seo1 ? 'Yes' : 'No' }}</td>
                    <td>{{ $advert->seo2 ? 'Yes' : 'No' }}</td>
                    <td>{{ $advert->active ? 'Yes' : 'No' }}</td>
                    <td>{{ $advert->paid ? 'Yes' : 'No' }}</td>
                    <td>{{ \Carbon\Carbon::parse($advert->start_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($advert->expiry_date)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="14" class="text-center">No adverts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
