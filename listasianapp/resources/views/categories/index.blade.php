@extends('layouts.app')

@if ($model !== null)
    @php
        $pageTitle = $model->getPageTitle();
        $seoKeywords = $model->url;
        $seoDescription = $model->getSeoDescription();
    @endphp
@endif

@push('scripts')
    <script src="{{ asset('js/regions.js') }}"></script>
    <script src="{{ asset('js/category.js') }}"></script>
@endpush

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
                        <form method="POST" action="{{ route('search') }}">
                            @csrf
                            <div class="col-md-6">
                                <x-select2 :model="$geoForm" field="country_id" :options="$countries" allowClear="true" />
                            </div>
                            <div class="col-md-6">
                                <x-select2 :model="$geoForm" field="region_id" :options="$regions" allowClear="true" />
                            </div>
                            <div class="col-md-12">
                                <div id="sub_region" style="display: none;">
                                    <x-select2 :model="$geoForm" field="sub_region_id" :options="$subRegions" placeholder="None" />
                                </div>
                                <div class="search-wide-wrap">
                                    <div class="search-block">
                                        <label for="search-input">
                                            <input type="search" name="q" placeholder="Search for a Wedding Supplier/Business here..." value="{{ request('q') }}" />
                                            <label for="wide-search-submit"><i class="fa fa-search" aria-hidden="true"></i></label>
                                            <input class="search-submit" id="wide-search-submit" type="submit">
                                        </label>
                                        <div class="search-options">
                                            @foreach(Category::$searchType as $key => $type)
                                                <input type="radio" name="t" value="{{ $key }}" id="t2{{ $key }}" {{ request('t') == $key ? 'checked' : '' }}>
                                                <label for="t2{{ $key }}">{{ $type }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit">START</button>
                                    <button type="button" id="bGeo">GEO</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    window.location.hash = 'category-anchor';
                </script>

                {{-- ListView --}}
                <x-list-view :dataProvider="$dataProvider" :itemView="$itemView" class="booster-list-view" />
            </div>
        </div>
    </div>

    <script>
        var country_id = '{{ $geoForm->country_id }}';
        var region_id = '{{ $geoForm->region_id }}';
    </script>
@endsection
