@extends('layouts.app')

@section('content')
@php
    Breadcrumbs::register('category.view', function ($breadcrumbs) use ($model) {
        $breadcrumbs->push('Categories', route('category.index'));
        $breadcrumbs->push($model->name, route('category.show', ['id' => $model->id]));
    });
@endphp

@section('title', 'View Category #' . $model->id)

<h1>View Category #{{ $model->id }}</h1>

{{-- Detail View --}}
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $model->id }}</td>
            </tr>
            <tr>
                <th>Code</th>
                <td>{{ $model->code }}</td>
            </tr>
            <tr>
                <th>Parent ID</th>
                <td>{{ $model->parent_id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $model->name }}</td>
            </tr>
            <tr>
                <th>URL</th>
                <td>{{ $model->url }}</td>
            </tr>
            <tr>
                <th>Create Time</th>
                <td>{{ $model->create_time }}</td>
            </tr>
            <tr>
                <th>Update Time</th>
                <td>{{ $model->update_time }}</td>
            </tr>
        </tbody>
    </table>
</div>

{{-- Menu Actions --}}
<div class="btn-group" role="group">
    <a href="{{ route('category.list') }}" class="btn btn-default">List Category</a>
    <a href="{{ route('category.createForm') }}" class="btn btn-primary">Create Category</a>
    <a href="{{ route('category.edit', $model->id) }}" class="btn btn-warning">Update Category</a>
    <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">Delete Category</a>
    <form id="delete-form" action="{{ route('category.destroy', $model->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <a href="{{ route('category.admin') }}" class="btn btn-info">Manage Category</a>
</div>
@endsection
