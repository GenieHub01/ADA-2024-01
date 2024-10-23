<form method="POST" action="{{ route('category.create') }}" id="category-form">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label for="code">Code</label>
        <input type="text" name="code" class="form-control" value="{{ old('code') }}" id="code">
    </div>

    <div class="form-group">
        <label for="parent_id">Parent Category</label>
        <select name="parent_id" id="parent_id" class="form-control select2">
            <option value="0">Parent category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name">
    </div>


    <div class="form-group">
        <label for="url">URL</label>
        <input type="text" name="url" class="form-control" value="{{ old('url') }}" id="url">
    </div>

    <button type="submit" class="btn btn-primary" id="save">Save</button>
</form>
