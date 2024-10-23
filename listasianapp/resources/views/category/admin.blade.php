@extends('layouts.app')

@section('content')
<div class="col-md-12 company-list">
    <h3>Manage Categories</h3>

    <a href="{{ route('category.create') }}" class="btn btn-success">Create</a>

    <table class="table table-bordered" id="category-grid">
        <thead>
            <tr>
                <th>Code</th>
                <th>Parent Category</th>
                <th>Name</th>
                <th>URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->code }}</td>
                <td>{{ $category->parent ? $category->parent->name : 'Parent' }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->url }}</td>
                <td>
                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">Update</a>
                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="pagination">
        {{ $categories->links() }}
    </div>
</div>
@endsection
