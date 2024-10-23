<p>
    Review advert: <a href="{{ route('advert.update', ['id' => $advert->id]) }}">Link</a>
</p>

<p>
    User IP Address is: {{ request()->ip() }}
</p>
