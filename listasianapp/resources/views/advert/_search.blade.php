<form action="{{ route('advert.index') }}" method="GET">
    <div class="mb-3">
        <label for="id" class="form-label">ID</label>
        <input type="text" name="id" class="form-control" id="id" value="{{ old('id') }}">
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" maxlength="100">
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}" maxlength="200">
    </div>

    <div class="mb-3">
        <label for="postcode" class="form-label">Postcode</label>
        <input type="text" name="postcode" class="form-control" id="postcode" value="{{ old('postcode') }}" maxlength="20">
    </div>

    <div class="mb-3">
        <label for="telephone" class="form-label">Telephone</label>
        <input type="text" name="telephone" class="form-control" id="telephone" value="{{ old('telephone') }}" maxlength="20">
    </div>

    <div class="mb-3">
        <label for="fax" class="form-label">Fax</label>
        <input type="text" name="fax" class="form-control" id="fax" value="{{ old('fax') }}" maxlength="20">
    </div>

    <div class="mb-3">
        <label for="web" class="form-label">Web</label>
        <input type="text" name="web" class="form-control" id="web" value="{{ old('web') }}" maxlength="200">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}" maxlength="100">
    </div>

    <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <input type="text" name="rating" class="form-control" id="rating" value="{{ old('rating') }}">
    </div>

    <div class="mb-3">
        <label for="seo1" class="form-label">SEO1</label>
        <input type="text" name="seo1" class="form-control" id="seo1" value="{{ old('seo1') }}">
    </div>

    <div class="mb-3">
        <label for="seo2" class="form-label">SEO2</label>
        <input type="text" name="seo2" class="form-control" id="seo2" value="{{ old('seo2') }}">
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="text" name="start_date" class="form-control" id="start_date" value="{{ old('start_date') }}">
    </div>

    <div class="mb-3">
        <label for="expiry_date" class="form-label">Expiry Date</label>
        <input type="text" name="expiry_date" class="form-control" id="expiry_date" value="{{ old('expiry_date') }}">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="description" rows="6">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="text" name="image" class="form-control" id="image" value="{{ old('image') }}" maxlength="255">
    </div>

    <div class="mb-3">
        <label for="create_date" class="form-label">Create Date</label>
        <input type="text" name="create_date" class="form-control" id="create_date" value="{{ old('create_date') }}">
    </div>

    <div class="mb-3">
        <label for="update_date" class="form-label">Update Date</label>
        <input type="text" name="update_date" class="form-control" id="update_date" value="{{ old('update_date') }}">
    </div>

    <div class="mb-3">
        <label for="active" class="form-label">Active</label>
        <input type="text" name="active" class="form-control" id="active" value="{{ old('active') }}">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>
