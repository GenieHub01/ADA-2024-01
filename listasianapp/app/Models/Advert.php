<?php

namespace App\Models;

use App\Services\GeoService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Advert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'address',
        'postcode',
        'telephone',
        'mobile', 
        'fax',
        'web',
        'email',
        'rating',
        'seo1',
        'seo2',
        'description',
        'image',
        'active',
        'paid',
        'package',
        'lat',
        'lng',
        'country_id',
        'region_id',
        'sub_region_id',
        'city_id',
        'country_name',
        'city_name',
        'seo_keywords',
        'seo_description',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'gplus_url',
        'youtube_url',
        'pinterest_url',
        'country',
        'region'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subRegion(): BelongsTo
    {
        return $this->belongsTo(SubRegion::class, 'sub_region_id');
    }

    public function price(): BelongsTo
    {
        return $this->belongsTo(Price::class, 'package');
    }
    
    public function categoriesMany(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_advert', 'advert_id', 'category_id');
    }

    public $advertTypes = [
        'silver' => 'seo1',
        'platinum' => 'seo2',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($adverts) {
            /** @var \App\Models\User|null $user */
            $user = Auth::user();
            if ($user && $user->isAdmin()) {
                $adverts->active = 1;
                $adverts->paid = 1;
                $adverts->user_id = 1;
            }
        });

        static::saving(function ($adverts) {
            $geoServices = new GeoService();
            $adverts->country_name = $geoServices->getCountryName($adverts->country_id);
            $adverts->city_name = $geoServices->getCityName($adverts->country_id, $adverts->region_id, $adverts->city_id);
            $adverts->saveImage();
        });

        static::deleting(function ($adverts) {
            $adverts->deleteImage();
            Cache::forget(self::class . $adverts->id);
        });
    }

    public function saveImage()
    {
        if (request()->hasFile('file')) {
            $this->deleteImage();

            $file = request()->file('file');
            $name = md5(uniqid("")) . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/' . substr($name, 0, 2) . '/' . $name;
            Storage::put($path, file_get_contents($file));

            $this->image = $path;
        }
    }

    public function deleteImage()
    {
        if ($this->image && Storage::exists($this->image)) {
            Storage::delete($this->image);
        }
    }

    public function getPackage()
    {
        return $this->price ? $this->price->name : null;
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1)->where('paid', 1);
    }

    public function scopeSearch(Builder $query, $searchTerm)
    {
        return $query->where('name', 'like', "%{$searchTerm}%");
    }

    public function getSeoLink($name = null)
    {
        $name = $name ?: $this->name;
        $url = route('advert.display', [
            'id' => $this->id,
            'country' => $this->country,
            'region' => $this->region,
            'subcategory' => $this->categoriesMany->first()->url ?? null,
            'name' => Str::slug($name)
        ]);

        return "<a href='{$url}'>" . e($name) . "</a>";
    }

    public function getSeoCategory()
    {
        return $this->categoriesMany->first()->url ?? '';
    }

    public function getSeoName()
    {
        $name = $this->category->name;
        if ($this->categoriesMany->isNotEmpty()) {
            $name .= '/' . $this->categoriesMany->first()->name;
        }

        return "$name {$this->name}";
    }

    public function getSeoUrl()
    {
        $slug = Str::slug($this->name);
        return route('advert.display', [
            'id'            => $this->id,
            'country'       => $this->country,
            'region'        => $this->region,
            'subcategory'   => $this->categoriesMany->first()->url ?? null,
            'name'          => $slug
        ]);
    }

    public function getSeoKeywords()
    {
        if ($this->seo_keywords) {
            return $this->seo_keywords;
        }

        $value = $this->name;
        if ($this->categoriesMany->isNotEmpty()) {
            $value .= ', ' . $this->categoriesMany->first()->url;
        }

        return trim($value);
    }

    public function getSeoDescription()
    {
        $value = $this->name;
        if ($this->categoriesMany->isNotEmpty()) {
            $value .= ', ' . $this->categoriesMany->first()->url;
        }

        return $this->seo_description ?: trim($value);
    }
}
