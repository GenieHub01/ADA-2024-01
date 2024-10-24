<div class="view">

    <b>{{ __('ID') }}:</b>
    <a href="{{ route('user.show', $user->id) }}">{{ $user->id }}</a>
    <br />

    <b>{{ __('Email') }}:</b>
    {{ $user->email }}
    <br />

    <b>{{ __('Hash') }}:</b>
    {{ $user->hash }}
    <br />

    <b>{{ __('Created At') }}:</b>
    {{ $user->create_time->format('Y-m-d H:i:s') }}
    <br />

    <b>{{ __('Role') }}:</b>
    {{ $user->role }}
    <br />

</div>
