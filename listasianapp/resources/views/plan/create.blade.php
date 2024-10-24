@extends('layouts.app')

@section('content')
<div class="col-md-12 form-theme">
    <h3>Create</h3>

    @include('plan._form', ['model' => $model])
</div>
@endsection
