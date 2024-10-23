@extends('layouts.app')

@section('content')
<div class="col-md-12 form-theme">
    <h3>Create Category</h3>

    <ul class="nav">
        <li><a href="{{ route('category.index') }}">List Category</a></li>
        <li><a href="{{ route('category.admin') }}">Manage Category</a></li>
    </ul>

    @include('category._form', ['model' => $model])
</div>
@endsection
