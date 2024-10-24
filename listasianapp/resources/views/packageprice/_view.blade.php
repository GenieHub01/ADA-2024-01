<div class="view">

    <b>{{ __('ID') }}:</b>
    <a href="{{ route('package_prices.show', $data->id) }}">{{ $data->id }}</a>
    <br />

    <b>{{ __('Country ID') }}:</b>
    {{ $data->country_id }}
    <br />

    <b>{{ __('Region ID') }}:</b>
    {{ $data->region_id }}
    <br />

    <b>{{ __('Sub Region ID') }}:</b>
    {{ $data->sub_region_id }}
    <br />

    <b>{{ __('Price 1') }}:</b>
    {{ $data->price_1 }}
    <br />

    <b>{{ __('Price 2') }}:</b>
    {{ $data->price_2 }}
    <br />

    <b>{{ __('Price 3') }}:</b>
    {{ $data->price_3 }}
    <br />

</div>
