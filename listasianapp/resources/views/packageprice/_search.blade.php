<div class="wide form">
    <form action="{{ route('package_prices.index') }}" method="GET">

        <div class="row">
            <label for="id">{{ __('ID') }}</label>
            <input type="text" name="id" value="{{ request('id') }}" class="form-control">
        </div>

        <div class="row">
            <label for="country_id">{{ __('Country ID') }}</label>
            <input type="text" name="country_id" value="{{ request('country_id') }}" class="form-control">
        </div>

        <div class="row">
            <label for="region_id">{{ __('Region ID') }}</label>
            <input type="text" name="region_id" value="{{ request('region_id') }}" class="form-control">
        </div>

        <div class="row">
            <label for="sub_region_id">{{ __('Sub Region ID') }}</label>
            <input type="text" name="sub_region_id" value="{{ request('sub_region_id') }}" class="form-control">
        </div>

        <div class="row">
            <label for="price_1">{{ __('Price 1') }}</label>
            <input type="text" name="price_1" value="{{ request('price_1') }}" class="form-control">
        </div>

        <div class="row">
            <label for="price_2">{{ __('Price 2') }}</label>
            <input type="text" name="price_2" value="{{ request('price_2') }}" class="form-control">
        </div>

        <div class="row">
            <label for="price_3">{{ __('Price 3') }}</label>
            <input type="text" name="price_3" value="{{ request('price_3') }}" class="form-control">
        </div>

        <div class="row buttons">
            <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
        </div>
        
    </form>
</div>
