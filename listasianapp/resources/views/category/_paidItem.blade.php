<div class="view">

    <div>
        <b>{{ $data->name }}</b>
    </div>

    @if ($data->email)
    <div>
        <b><a href="mailto:{{ $data->email }}">{{ $data->email }}</a></b>
    </div>
    @endif

    @if ($data->telephone)
    <div>
        <a href="tel:{{ $data->telephone }}">call us</a>
    </div>
    @endif

    @if ($data->mobile)
    <div>
        <a href="tel:{{ $data->mobile }}">call us mobile</a>
    </div>
    @endif

    @if ($data->web)
    <div>
        <a href="{{ $data->web }}">site</a>
    </div>
    @endif

    <div>
        {{ nl2br(e($data->description)) }}
    </div>

</div>
