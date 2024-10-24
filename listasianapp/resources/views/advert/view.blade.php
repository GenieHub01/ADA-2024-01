@extends('layouts.app')

@section('content')
<div class="container">
    @if ($model->paid)
        <div class="advert-title">
            <div class="row">
                <div class="col-md-12">
                    <div class="about-nav">
                        {!! $model->prev ? $model->prev->getSeoLink('< Prev') : '' !!}
                        {!! $model->next ? $model->next->getSeoLink('Next >') : '' !!}
                    </div>
                    <h1>{{ $model->name }}</h1>
                    <a class="back-to-directory" href="/"><i class="fa fa-chevron-left"></i> Back to Directory</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <h4>{{ session('success') }}</h4>
                @endif
                <h2 class="subcategory">
                    <a href="{{ route('category.index', ['code' => $model->categorys->first()->getUrl() ?? '']) }}">
                        <i class="fa fa-chevron-left"></i>{{ $model->getSeoCategory() }}
                    </a>
                </h2>
            </div>

            <div class="col-md-6 about-content">
                <article class="about-description">
                    {!! nl2br(e($model->description)) !!}
                </article>
            </div>

            <div class="col-md-6 about-content">
                <div class="about-img">
                    <img src="{{ $model->image }}" alt="{{ $model->name }}" title="{{ $model->name }}">
                </div>

                <div class="about-contacts">
                    <p><span class="about-site"><a href="{{ $model->web }}" rel="nofollow" target="_blank">{{ $model->web }}</a></span></p>
                    <p><span class="about-phone"><a href="tel:{{ $model->telephone }}" rel="nofollow">{{ $model->telephone }}</a></span></p>
                    <p><span class="about-email"><a href="mailto:{{ $model->email }}" rel="nofollow">{{ $model->email }}</a></span></p>
                </div>

                <div class="about-socials">
                    @if ($model->facebook_url)
                        <a rel="nofollow" target="_blank" class="about-fb" href="{{ $model->facebook_url }}"></a>
                    @endif
                    @if ($model->twitter_url)
                        <a rel="nofollow" target="_blank" class="about-tw" href="{{ $model->twitter_url }}"></a>
                    @endif
                    @if ($model->pinterest_url)
                        <a rel="nofollow" target="_blank" class="about-pi" href="{{ $model->pinterest_url }}"></a>
                    @endif
                    @if ($model->instagram_url)
                        <a rel="nofollow" target="_blank" class="about-li" href="{{ $model->instagram_url }}"></a>
                    @endif
                    @if ($model->gplus_url)
                        <a rel="nofollow" target="_blank" class="about-gp" href="{{ $model->gplus_url }}"></a>
                    @endif
                    @if ($model->youtube_url)
                        <a rel="nofollow" target="_blank" class="about-yt" href="{{ $model->youtube_url }}"></a>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <div class="about-map-address">
                    {{ $model->address }}, {{ $model->postcode }}
                </div>
                <div id="map"></div>
            </div>
        </div>
    @else
        @include('partials.stripe', ['advert' => $model])
    @endif
</div>

<div id="myLatLngData" data-lat="{{ $model->lat ?? 0 }}" data-lng="{{ $model->lng ?? 0 }}"></div>
@push('scripts')
<script>
    function initMap() {
        var lat = document.getElementById('myLatLngData').getAttribute('data-lat');
        var lng = document.getElementById('myLatLngData').getAttribute('data-lng');
        var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lng)};

        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            scrollwheel: false,
            zoom: 15
        });

        var marker = new google.maps.Marker({
            map: map,
            position: myLatLng,
            icon: {
                url: 'https://list.asiandirectoryapp.com/images/marker.svg',
                size: new google.maps.Size(32, 41),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(16, 40)
            },
            title: '{{ $model->name }}'
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                var distance = google.maps.geometry.spherical.computeDistanceBetween(pos, marker.position);
                var distanceInMiles = (distance * 0.000621371).toFixed(1);
                $('<span/>', {
                    class: 'distance',
                    text: distanceInMiles + ' miles'
                }).appendTo('.about-map-address');
            });
        }
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=geometry&callback=initMap"></script>

<script>
    fbq('track', 'ViewContent', {
        content_name: "{{ $model->name }}",
        content_category: "{{ $model->getSeoCategory() }}",
        content_ids: ["{{ $model->id }}"],
        content_type: 'ADA-Advert',
        value: 0.00,
        currency: 'GBP'
    });

    function tracker(id) {
        var o = {
            site: 'Website',
            phone: 'Phone',
            email: 'Email',
            fb: 'Facebook',
            tw: 'Twitter',
            pi: 'Pinterest',
            li: 'Linkedin',
            gp: 'Google+',
            yt: 'Youtube'
        };

        fbq('trackCustom', 'Click-' + o[id], {
            content_name: "{{ $model->name }}",
            content_category: "{{ $model->getSeoCategory() }}",
            content_ids: ["{{ $model->id }}"],
            content_type: 'ADA-Advert',
            value: 0.00,
            currency: 'GBP'
        });

        ga('send', {
            hitType: 'event',
            eventCategory: "{{ $model->getSeoCategory() }}",
            eventAction: "{{ $model->name }}",
            eventLabel: 'Click-' + o[id]
        });
    }

    $('.about-contacts span, .about-socials a').click(function() {
        tracker($(this).attr('class').split('-')[1]);
    });
</script>
@endpush

@endsection
