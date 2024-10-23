@extends('layouts.app')

@section('content')

{{-- Include JavaScript --}}
@push('scripts')
    <script src="/js/regions.js"></script>
@endpush

<form action="{{ route('package_prices.store') }}" method="POST" id="package-price-form">
    @csrf

    {{-- Country Select --}}
    <div class="form-group">
        <label for="country_id">{{ __('Country') }}</label>
        <select name="country_id" id="country_id" class="form-select select2">
            <option value="">{{ __('Select country') }}</option>
            @foreach(\App\Services\GeoService::getCountries() as $id => $name)
                <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Ajax Regions Select --}}
    <div class="form-group">
        <label for="region_id">{{ __('Region') }}</label>
        <select name="region_id" id="region_id" class="form-select select2">
            <option value="">{{ __('Select region') }}</option>
            @foreach(\App\Services\GeoService::getRegions(old('country_id')) as $id => $name)
                <option value="{{ $id }}" {{ old('region_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Sub Region Select --}}
    <div id="sub_region" class="form-group">
        <label for="sub_region_id">{{ __('Sub Region') }}</label>
        <select name="sub_region_id" id="sub_region_id" class="form-select select2">
            <option value="">{{ __('None') }}</option>
            @foreach(\App\Models\SubRegion::all() as $subRegion)
                <option value="{{ $subRegion->id }}" {{ old('sub_region_id') == $subRegion->id ? 'selected' : '' }}>{{ $subRegion->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Price Fields --}}
    <div class="form-group">
        <label for="price_1">{{ __('Price 1') }}</label>
        <input type="text" name="price_1" id="price_1" class="form-control" value="{{ old('price_1') }}">
    </div>

    <div class="form-group">
        <label for="price_2">{{ __('Price 2') }}</label>
        <input type="text" name="price_2" id="price_2" class="form-control" value="{{ old('price_2') }}">
    </div>

    <div class="form-group">
        <label for="price_3">{{ __('Price 3') }}</label>
        <input type="text" name="price_3" id="price_3" class="form-control" value="{{ old('price_3') }}">
    </div>

    {{-- Submit Button --}}
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();

        // Country select change event to load regions via AJAX
        $('#country_id').change(function() {
            var countryId = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route("geo.regions") }}',
                data: {
                    country_id: countryId,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    $('#region_id').html('').select2();
                },
                success: function(data) {
                    $('#region_id').html(data).select2();
                }
            });
        });

    });
</script>
@endpush
