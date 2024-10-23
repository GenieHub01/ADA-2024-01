@extends('layouts.app')

@section('content')
<div class="col-md-12 form-theme">

    <h3>Update Advert {{ $model->id }}</h3>

    <div class="mb-3">
        <a href="{{ route('advert.create') }}" class="btn btn-success">Create Advert</a>
        <a href="{{ route('advert.view', $model->id) }}" class="btn btn-primary">View Advert</a>
        <a href="{{ route('advert.admin') }}" class="btn btn-secondary">Manage Advert</a>
    </div>

    @include('advert._form', ['model' => $model])

</div>
@endsection
