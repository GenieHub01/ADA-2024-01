<div class="wide form">
    <form action="{{ route('paylogs.index') }}" method="GET">
        <div class="row">
            <label for="id">{{ __('ID') }}</label>
            <input type="text" name="id" id="id" value="{{ request('id') }}">
        </div>

        <div class="row">
            <label for="user_id">{{ __('User ID') }}</label>
            <input type="text" name="user_id" id="user_id" value="{{ request('user_id') }}">
        </div>

        <div class="row">
            <label for="advert_id">{{ __('Advert ID') }}</label>
            <input type="text" name="advert_id" id="advert_id" value="{{ request('advert_id') }}">
        </div>

        <div class="row">
            <label for="amount">{{ __('Amount') }}</label>
            <input type="text" name="amount" id="amount" value="{{ request('amount') }}" maxlength="10" size="10">
        </div>

        <div class="row">
            <label for="create_time">{{ __('Create Time') }}</label>
            <input type="text" name="create_time" id="create_time" value="{{ request('create_time') }}">
        </div>

        <div class="row buttons">
            <button type="submit">{{ __('Search') }}</button>
        </div>
    </form>
</div>
