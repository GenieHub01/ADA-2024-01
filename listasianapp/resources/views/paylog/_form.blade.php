<form action="{{ isset($paylog) ? route('paylogs.update', $paylog->id) : route('paylogs.store') }}" method="POST" id="paylog-form">
    @csrf
    @if(isset($paylog))
        @method('PUT')
    @endif

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label for="user_id">{{ __('User ID') }}</label>
        <input type="text" name="user_id" id="user_id" value="{{ old('user_id', isset($paylog) ? $paylog->user_id : '') }}" class="form-control">
        @error('user_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="advert_id">{{ __('Advert ID') }}</label>
        <input type="text" name="advert_id" id="advert_id" value="{{ old('advert_id', isset($paylog) ? $paylog->advert_id : '') }}" class="form-control">
        @error('advert_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="amount">{{ __('Amount') }}</label>
        <input type="text" name="amount" id="amount" value="{{ old('amount', isset($paylog) ? $paylog->amount : '') }}" maxlength="10" class="form-control">
        @error('amount')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="create_time">{{ __('Create Time') }}</label>
        <input type="text" name="create_time" id="create_time" value="{{ old('create_time', isset($paylog) ? $paylog->create_time : '') }}" class="form-control">
        @error('create_time')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary" id="save">{{ isset($paylog) ? 'Update' : 'Create' }}</button>
    </div>
</form>
