<div class="view">
    <b>{{ __('ID') }}:</b>
    <a href="{{ route('paylogs.show', $paylog->id) }}">{{ $paylog->id }}</a>
    <br />

    <b>{{ __('User ID') }}:</b>
    {{ $paylog->user_id }}
    <br />

    <b>{{ __('Advert ID') }}:</b>
    {{ $paylog->advert_id }}
    <br />

    <b>{{ __('Amount') }}:</b>
    {{ $paylog->amount }}
    <br />

    <b>{{ __('Create Time') }}:</b>
    {{ $paylog->create_time }}
    <br />
</div>
