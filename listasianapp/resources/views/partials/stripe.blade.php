<div class="advert-section">
    @if($advert->image)
        <img src="{{ Storage::url($advert->image) }}" alt="{{ $advert->name }}" class="advert-image">
    @endif

    <h2>{{ $advert->name }}</h2>

    <p>{{ $advert->description }}</p>

    @if($advert->price)
        <p><strong>Price:</strong> {{ $advert->price->name }}</p>
    @endif

    @if($advert->category)
        <p><strong>Category:</strong> {{ $advert->category->name }}</p>
    @endif

    <p><a href="{{ $advert->getSeoUrl() }}" class="seo-link">View more details</a></p>
</div>

<style>
    .advert-section {
        border: 1px solid #ccc;
        padding: 15px;
        margin: 10px 0;
    }
    .advert-image {
        width: 100%;
        max-width: 300px;
        height: auto;
        margin-bottom: 15px;
    }
    .seo-link {
        color: #007bff;
        text-decoration: none;
    }
    .seo-link:hover {
        text-decoration: underline;
    }
</style>
