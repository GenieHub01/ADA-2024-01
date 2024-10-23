@extends('layouts.app')

@section('content')
@php
    $pagePart = isset($page) && $page ? ' - Page ' . $page : '';
    $pageTitle = config('app.name') . ' - ' . $category->getUrlConverted() . $pagePart;

    $scripts = [
        asset('js/regions.js'),
        asset('js/category.js'),
    ];
@endphp

@section('title', $pageTitle)
@push('scripts')
    @foreach($scripts as $script)
        <script src="{{ $script }}"></script>
    @endforeach
@endpush

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
                {{-- TreeView --}}
                @include('components.treeview', ['data' => $treeViewData])
            </div>
        </div>

        <div class="col-md-8 company-list-right">
            <div class="location-form">
                <div id="console" class="alert-danger"></div>
                <div class="row">
                    <form action="{{ route('category.list') }}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            {{-- Country Selection --}}
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
                            {{-- Region Selection --}}
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
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="sub_region" style="display: none;">
                                {{-- Sub-region Selection --}}
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

                            <div class="search-wide-wrap">
                                <div class="search-block">
                                    <form action="/" method='get'>
                                        <label for="search-input">
                                            <input type="text" name="q" value="{{ request()->get('q') }}" placeholder="Search for a Wedding Supplier/Business here..." class="form-control">
                                            <label for="wide-search-submit"><i class="fa fa-search" aria-hidden="true"></i></label>
                                            <input class="search-submit" id="wide-search-submit" type="submit">
                                        </label>

                                        <div>
                                            @foreach(\App\Models\Category::$searchType as $key => $value)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="t" id="t{{ $key }}" value="{{ $key }}" {{ request()->get('t', 0) == $key ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="t{{ $key }}">
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="submit-location">
                                <label for="wide-search-submit">Search</label>
                                <button type="submit" class="btn btn-success">START</button>
                                <button type="button" class="btn btn-info" id="bGeo">GEO</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <script>
                window.location.hash = 'category-anchor';
            </script>

            {{-- List View --}}
            <div class="company-list-view">
                @foreach($dataProvider as $item)
                    @include('category._item', ['item' => $item])
                @endforeach
            </div>
            {{-- Pagination --}}
            <div class="pagination">
                {{ $dataProvider->links() }} {{-- Assuming pagination is set --}}
            </div>
        </div>
    </div>
</div>

<script>
    var country_id = '{{ $geoForm->country_id }}';
    var region_id = '{{ $geoForm->region_id }}';
</script>
@endsection
