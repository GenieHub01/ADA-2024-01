<div class="wide form">
    <form action="{{ route(request()->route()->getName()) }}" method="GET">
        @csrf

        <div class="row">
            <label for="id">ID</label>
            <input type="text" name="id" id="id" value="{{ request('id') }}">
        </div>

        <div class="row">
            <label for="code">Code</label>
            <input type="text" name="code" id="code" value="{{ request('code') }}" size="10" maxlength="10">
        </div>

        <div class="row">
            <label for="parent_id">Parent ID</label>
            <input type="text" name="parent_id" id="parent_id" value="{{ request('parent_id') }}">
        </div>

        <div class="row">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ request('name') }}" size="60" maxlength="100">
        </div>

        <div class="row">
            <label for="create_time">Create Time</label>
            <input type="text" name="create_time" id="create_time" value="{{ request('create_time') }}">
        </div>

        <div class="row">
            <label for="update_time">Update Time</label>
            <input type="text" name="update_time" id="update_time" value="{{ request('update_time') }}">
        </div>

        <div class="row buttons">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
