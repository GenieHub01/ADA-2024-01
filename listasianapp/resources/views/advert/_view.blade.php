<div class="company-list-item">
    
    <a href="{{ $data->getSeoUrl() }}">
        <i class="fa fa-external-link advert-link"></i>
        <h4>{{ $data->name }}</h4>

        <div>
            <b>{{ __('Address') }}:</b>
            {{ $data->address }}
        </div>

        <div>
            <b>{{ __('Postcode') }}:</b>
            {{ $data->postcode }}
        </div>

        <div>
            <b>{{ __('Telephone') }}:</b>
            {{ $data->telephone }}
        </div>

        @if ($data->web)
            <div>
                <b>{{ __('Web') }}:</b>
                <a href="{{ $data->web }}" target="_blank">{{ $data->web }}</a>
            </div>
        @endif
    </a>

</div>
