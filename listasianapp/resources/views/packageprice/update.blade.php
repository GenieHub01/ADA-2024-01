@extends('layouts.app')

@section('content')
    <div class="col-md-12 form-theme">
        <h3>Update Price</h3>

        @include('packageprice._form', ['packagePrice' => $packagePrice])
    </div>
@endsection
