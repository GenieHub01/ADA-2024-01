{{-- @var $this Controller --}}
@extends('layouts.app')

@section('content')
    <div class="">
        {{-- Menampilkan menu dengan tipe 'pills' --}}
        <x-menu :items="$menu" type="pills" />
    </div>

    <div class="">
        <div id="content">
            {!! $content !!}
        </div><!-- content -->
    </div>
@endsection
