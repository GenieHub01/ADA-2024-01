@extends('layouts.app')

@section('content')
<section id="company-list-title">
    <div class="container">
        <h1 id="category-anchor"><strong>Company</strong> list</h1>
    </div>
</section>

<div class="container category-index">
    <div class="col-md-12 company-list">
        <p class="company-list-purpose">
            <span>Enter <strong>your location</strong>,</span>
            <span>and let us help you <strong>sort the adverts</strong>.</span>
        </p>

        <div class="col-md-4 company-list-left">
            <div class="list-tree-block">
                {{-- Tree view section --}}
                @include('components.treeview', ['treeViewData' => $treeViewData])
            </div>
        </div>

        <div class="col-md-8 company-list-right">
            <div class="location-form">
                <div id="console" class="alert-danger"></div>
                <div class="row">
                    <form action="{{ route('category.list') }}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            {{-- Country selection --}}
                            <div class="form-group">
                                <label for="country_id">Country</label>
                                <select name="country_id" id="country_id" class="form-control">
                                    <option value="" selected>Select a country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ $geoForm->country_id == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- Region selection --}}
                            <div class="form-group">
                                <label for="region_id">Region</label>
                                <select name="region_id" id="region_id" class="form-control">
                                    <option value="" selected>Select a region</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ $geoForm->region_id == $region->id ? 'selected' : '' }}>
                                            {{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                {{-- Subregion selection --}}
                                <div id="sub_region" style="display: none;">
                                    <div class="form-group">
                                        <label for="sub_region_id">Sub Region</label>
                                        <select name="sub_region_id" id="sub_region_id" class="form-control">
                                            <option value="">None</option>
                                            @foreach($subRegions as $subRegion)
                                                <option value="{{ $subRegion->id }}">
                                                    {{ $subRegion->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Search form --}}
                                <div class="search-wide-wrap">
                                    <div class="search-block">
                                        <form action="/" method='GET'>
                                            <label for="search-input">
                                                <input type="text" name="q" value="{{ request()->get('q') }}" placeholder="Search for a Wedding Supplier/Business here..." class="form-control">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                            </label>
                                            <div class="form-group">
                                                @foreach(\App\Models\Category::$searchType as $key => $value)
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="t" value="{{ $key }}" {{ request()->get('t', 0) == $key ? 'checked' : '' }}>
                                                            {{ $value }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Search buttons --}}
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">START</button>
                                <button type="button" class="btn btn-info" id="bGeo">GEO</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- List view section --}}
            <div class="company-list-view">
                @foreach($categories as $category)
                    <div class="category-item">
                        {{-- Custom item rendering --}}
                        @include('category._item', ['category' => $category])
                    </div>
                @endforeach

                {{-- Pagination --}}
                <div class="pagination">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var country_id = '{{ $geoForm->country_id }}';
    var region_id = '{{ $geoForm->region_id }}';
</script>
@endsection
