@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>View Package Price #{{ $packagePrice->id }}</h1>

        <ul class="breadcrumb">
            <li><a href="{{ route('package_prices.index') }}">Package Prices</a></li>
            <li>{{ $packagePrice->id }}</li>
        </ul>

        <div class="menu">
            <a href="{{ route('package_prices.index') }}">List Package Prices</a> |
            <a href="{{ route('package_prices.create') }}">Create Package Price</a> |
            <a href="{{ route('package_prices.edit', $packagePrice->id) }}">Update Package Price</a> |
            <form action="{{ route('package_prices.destroy', $packagePrice->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')">Delete Package Price</button>
            </form> |
            <a href="{{ route('package_prices.admin') }}">Manage Package Prices</a>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $packagePrice->id }}</td>
            </tr>
            <tr>
                <th>Country ID</th>
                <td>{{ $packagePrice->country_id }}</td>
            </tr>
            <tr>
                <th>Region ID</th>
                <td>{{ $packagePrice->region_id }}</td>
            </tr>
            <tr>
                <th>Sub Region ID</th>
                <td>{{ $packagePrice->sub_region_id }}</td>
            </tr>
            <tr>
                <th>Price 1</th>
                <td>{{ $packagePrice->price_1 }}</td>
            </tr>
            <tr>
                <th>Price 2</th>
                <td>{{ $packagePrice->price_2 }}</td>
            </tr>
            <tr>
                <th>Price 3</th>
                <td>{{ $packagePrice->price_3 }}</td>
            </tr>
        </table>
    </div>
@endsection
