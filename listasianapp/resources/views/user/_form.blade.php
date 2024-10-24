<form action="{{ route('user.store') }}" method="POST" id="user-form">
    @csrf

    <!-- First Name -->
    <div class="mb-3">
        <label for="f_name" class="form-label">{{ __('First Name') }}</label>
        <input type="text" name="f_name" id="f_name" value="{{ old('f_name') }}" class="form-control">
    </div>

    <!-- Last Name -->
    <div class="mb-3">
        <label for="l_name" class="form-label">{{ __('Last Name') }}</label>
        <input type="text" name="l_name" id="l_name" value="{{ old('l_name') }}" class="form-control">
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
    </div>

    <!-- Phone -->
    <div class="mb-3">
        <label for="phone" class="form-label">{{ __('Phone') }}</label>
        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" autocomplete="tel" class="form-control">
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
        <label for="password2" class="form-label">{{ __('Confirm Password') }}</label>
        <input type="password" name="password2" id="password2" class="form-control">
    </div>

    <!-- Discount -->
    <div class="mb-3">
        <label for="discount" class="form-label">{{ __('Discount') }}</label>
        <input type="number" name="discount" id="discount" value="{{ old('discount') }}" class="form-control">
    </div>

    <!-- Expiry Date -->
    <div class="mb-3">
        <label for="expiry" class="form-label">{{ __('Expiry Date') }}</label>
        <div class="input-group">
            <input type="date" name="expiry" id="expiry" value="{{ old('expiry') }}" class="form-control">
            <span class="input-group-text"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
    </div>

    <!-- Notes -->
    <div class="mb-3">
        <label for="notes" class="form-label">{{ __('Notes') }}</label>
        <textarea name="notes" id="notes" rows="10" class="form-control">{{ old('notes') }}</textarea>
    </div>

    <!-- Submit Button -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>
