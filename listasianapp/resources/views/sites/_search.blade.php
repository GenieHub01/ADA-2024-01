@php
    use App\Models\Category;
@endphp

<div class="search-block">
    <form action="/" method="GET">
        <label for="search-input">
            <input type="search" name="q" id="search-input" placeholder="Search for a Wedding Supplier/Business here..." value="{{ request('q') }}">
            <label for="search-submit"><i class="fa fa-search" aria-hidden="true"></i></label>
            <input class="search-submit" id="search-submit" type="submit">
        </label>
        @foreach (Category::$searchType as $key => $value)
            <label>
                <input type="radio" name="t" value="{{ $key }}" {{ request('t', 0) == $key ? 'checked' : '' }}> {{ $value }}
            </label>
        @endforeach
    </form>
</div>