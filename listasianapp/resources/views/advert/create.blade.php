@extends('layouts.app')

@section('content')
<div class="col-md-12 form-theme">

    <h3>Create Advert</h3>

    <div class="mb-3">
        <a href="{{ route('advert.index') }}" class="btn btn-primary">List Advert</a>
        <a href="{{ route('advert.admin') }}" class="btn btn-secondary">Manage Advert</a>
    </div>

    @include('advert._form', ['model' => $model])

</div>
@endsection
