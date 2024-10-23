@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Breadcrumbs --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('package_prices.index') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Package Prices</li>
            </ol>
        </nav>

        {{-- Menu --}}
        <div class="mb-3">
            <a href="{{ route('package_prices.create') }}" class="btn btn-primary">Create PackagePrice</a>
            <a href="{{ route('package_prices.admin') }}" class="btn btn-secondary">Manage PackagePrice</a>
        </div>

        {{-- Title --}}
        <h1>Package Prices</h1>

        {{-- List View --}}
        @foreach($packagePrices as $packagePrice)
            @include('packageprice._view', ['packagePrice' => $packagePrice])
        @endforeach

        {{-- Pagination --}}
        {{ $packagePrices->links() }}
    </div>
@endsection
