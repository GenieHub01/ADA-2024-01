<div class="wide form">
    <form action="{{ route('user.index') }}" method="GET">
        <!-- ID Field -->
        <div class="row mb-3">
            <label for="id" class="form-label">{{ __('ID') }}</label>
            <input type="text" name="id" id="id" value="{{ request('id') }}" class="form-control">
        </div>

        <!-- Email Field -->
        <div class="row mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="text" name="email" id="email" value="{{ request('email') }}" class="form-control" maxlength="200">
        </div>

        <!-- Hash Field -->
        <div class="row mb-3">
            <label for="hash" class="form-label">{{ __('Hash') }}</label>
            <input type="text" name="hash" id="hash" value="{{ request('hash') }}" class="form-control" maxlength="60">
        </div>

        <!-- Create Time Field -->
        <div class="row mb-3">
            <label for="create_time" class="form-label">{{ __('Create Time') }}</label>
            <input type="text" name="create_time" id="create_time" value="{{ request('create_time') }}" class="form-control">
        </div>

        <!-- Role Field -->
        <div class="row mb-3">
            <label for="role" class="form-label">{{ __('Role') }}</label>
            <input type="text" name="role" id="role" value="{{ request('role') }}" class="form-control">
        </div>

        <!-- Submit Button -->
        <div class="row">
            <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
        </div>
    </form>
</div>
