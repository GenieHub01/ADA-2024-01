@extends('layouts.app')

@section('content')
<div class="row">
    <form action="{{ route('advert.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="previewFile" value="{{ old('previewFile', $model->previewFile) }}">

        <div class="col-md-12">
            @if($model->image)
                <div class="form-group">
                    <img src="{{ asset($model->image) }}" alt="Advert Image">
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-5">
                <!-- Country Dropdown -->
                <div class="form-group">
                    <label for="country_id">Country</label>
                    <select name="country_id" id="country_id" class="form-control" onchange="fetchRegions()">
                        <option value="">Select country</option>
                        @foreach(Geo::getCountries() as $country_id => $country_name)
                            <option value="{{ $country_id }}" {{ $model->country_id == $country_id ? 'selected' : '' }}>
                                {{ $country_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Region Dropdown -->
                <div class="form-group">
                    <label for="region_id">Region</label>
                    <select name="region_id" id="region_id" class="form-control" onchange="fetchCities()">
                        <option value="">Select region</option>
                        @foreach(Geo::getRegions($model->country_id) as $region_id => $region_name)
                            <option value="{{ $region_id }}" {{ $model->region_id == $region_id ? 'selected' : '' }}>
                                {{ $region_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sub Region Dropdown -->
                <div id="sub_region" class="form-group">
                    <label for="sub_region_id">Sub Region</label>
                    <select name="sub_region_id" id="sub_region_id" class="form-control">
                        <option value="">None</option>
                        @foreach(SubRegion::all() as $subRegion)
                            <option value="{{ $subRegion->id }}" {{ $model->sub_region_id == $subRegion->id ? 'selected' : '' }}>
                                {{ $subRegion->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- City Dropdown -->
                <div class="form-group">
                    <label for="city_id">City</label>
                    <select name="city_id" id="city_id" class="form-control">
                        @foreach(\app\Services\GeoService::getCities($model->country_id, $model->region_id) as $city_id => $city_name)
                            <option value="{{ $city_id }}" {{ $model->city_id == $city_id ? 'selected' : '' }}>
                                {{ $city_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- GEO Button -->
                <button type="button" id="bGeo" class="btn btn-default geo-btn">GEO</button>
            </div>

            <div class="col-md-5">
                <!-- File Upload -->
                <div class="form-group">
                    <label for="file">File</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>

                <!-- Other fields -->
                <x-form-input label="Name" name="name" :value="old('name', $model->name)" />
                <x-form-input label="Address" name="address" :value="old('address', $model->address)" />
                <x-form-input label="Postcode" name="postcode" :value="old('postcode', $model->postcode)" />
                <x-form-input label="Telephone" name="telephone" :value="old('telephone', $model->telephone)" />
                <x-form-input label="Fax" name="fax" :value="old('fax', $model->fax)" />

                <div class="adv-toggle">&#x25BC; Advanced &#x25BC;</div>
            </div>
        </div>

        <!-- Advanced Section -->
        <div class="adv-advanced" style="display: none;">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <x-form-input label="Facebook URL" name="facebook_url" :value="old('facebook_url', $model->facebook_url)" />
                        <x-form-input label="Twitter URL" name="twitter_url" :value="old('twitter_url', $model->twitter_url)" />
                        <x-form-input label="Instagram URL" name="instagram_url" :value="old('instagram_url', $model->instagram_url)" />
                        <x-form-input label="YouTube URL" name="youtube_url" :value="old('youtube_url', $model->youtube_url)" />
                        <x-form-input label="Pinterest URL" name="pinterest_url" :value="old('pinterest_url', $model->pinterest_url)" />
                    </div>

                    <div class="col-md-5">
                        <x-form-input label="SEO Keywords" name="seo_keywords" :value="old('seo_keywords', $model->seo_keywords)" />
                        <x-form-textarea label="SEO Description" name="seo_description" :value="old('seo_description', $model->seo_description)" />
                        
                        @if(Auth::user()->isAdmin())
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    @foreach(User::all() as $user)
                                        <option value="{{ $user->id }}" {{ $model->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <x-form-input label="Expiry Date" name="expiry_date" type="date" :value="old('expiry_date', $model->expiry_date)" />
                            <x-form-input label="Rating" name="rating" :value="old('rating', $model->rating)" />
                            <x-form-checkbox label="Active" name="active" :checked="old('active', $model->active)" />
                            <x-form-checkbox label="Paid" name="paid" :checked="old('paid', $model->paid)" />
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-md-12 create-save">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('bGeo').addEventListener('click', getLocation);

    function fetchRegions() {
        
    }

    function fetchCities() {
        
    }

    function getLocation() {
        
    }
</script>
@endsection
