@extends('layouts.app')

@section('content')
@php
    // Breadcrumbs
    Breadcrumbs::register('category.update', function ($breadcrumbs) use ($model) {
        $breadcrumbs->push('Categories', route('category.index'));
        $breadcrumbs->push($model->name, route('category.show', $model->id));
        $breadcrumbs->push('Update');
    });
@endphp

@section('title', 'Update Category ' . $model->id)

<div class="col-md-12 form-theme">
    <h3>Update Category {{ $model->id }}</h3>

    {{-- Form Partial --}}
    @include('category._form', ['model' => $model])
</div>
@endsection
