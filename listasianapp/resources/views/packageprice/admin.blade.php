@extends('layouts.app')

@section('content')
<div class="col-md-12 company-list">

    {{-- Title --}}
    <h3>Prices ({{ \App\Helpers\Opay::CURRENCY }})</h3>

    {{-- Create Button --}}
    <a href="{{ route('package_prices.create') }}" class="btn btn-success">Create</a>

    {{-- Table Grid --}}
    <table class="table table-bordered" id="package-price-grid">
        <thead>
            <tr>
                <th>Country</th>
                <th>Region</th>
                <th>Sub Region</th>
                <th>Price 1</th>
                <th>Price 2</th>
                <th>Price 3</th>
                <th>Count</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packagePrices as $price)
                <tr>
                    <td>
                        <select class="form-select select2" name="country_id" data-allow-clear="true">
                            <option value="">{{ __('Select Country') }}</option>
                            @foreach(\App\Services\GeoService::getCountries() as $id => $name)
                                <option value="{{ $id }}" {{ $price->country_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>{{ $price->region_name }}</td>
                    <td>{{ $price->sub_region_id ? $price->subRegion->name : 'none' }}</td>
                    <td style="width: 7%;">{{ $price->price_1 }}</td>
                    <td style="width: 7%;">{{ $price->price_2 }}</td>
                    <td style="width: 7%;">{{ $price->price_3 }}</td>
                    <td>{{ \App\Models\Advert::where(['country_id' => $price->country_id, 'region_id' => $price->region_id, 'sub_region_id' => $price->sub_region_id])->count() }}</td>
                    <td>
                        <a href="{{ route('package_prices.edit', $price->id) }}" class="btn btn-sm btn-primary">Update</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $packagePrices->links() }}

</div>
@endsection
