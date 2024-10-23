@extends('layouts.app')

@section('content')
<style>
    .slick-prev:before,
    .slick-next:before {
        color: #f8e3ad;
    }
</style>

<div class="col-lg-12">
    {{-- List view to display items --}}
    @foreach($dataProvider as $item)
        @include('category._paidItem', ['item' => $item])
    @endforeach
</div>

<script>
    // Check if device is mobile and initialize slick slider
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $('.items').slick();
    }
</script>
@endsection
