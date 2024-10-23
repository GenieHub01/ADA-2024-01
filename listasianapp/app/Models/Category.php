<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'parent_id',
        'name',
        'url',
    ];

    public function adverts(): HasMany
    {
        return $this->hasMany(Advert::class, 'category_id');
    }
    
    public function advertsMany(): BelongsToMany
    {
        return $this->belongsToMany(Advert::class, 'category_advert', 'category_id', 'advert_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id')->orderBy('name');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('name');
    }

    public static $searchType = [
        0 => 'All business',
        1 => 'Only categories',
    ];

    public static function rules($isNew = false)
    {
        return [
            'name' => 'required|max:255',
            'code' => 'unique:categories,code',
            'url' => 'required|unique:categories,url|max:255',
            'parent_id' => 'nullable|integer'
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $existingCategory = Category::where('name', $category->name)->first();
    
            if ($existingCategory) {
                throw ValidationException::withMessages([
                    'name' => 'Category "' . $category->name . '" already have.'
                ]);
            }
    
            if (empty($category->code)) {
                $category->code = $category->generateCodeFromName($category->name);
            }
    
            $baseSlug = Str::slug($category->name);
            $slug = $baseSlug;
            $counter = 1;
    
            while (Category::where('url', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
    
            $category->url = $slug;
        });
    
        static::created(function ($category) {
            $code = $category->generateCodeFromName($category->name);
    
            if (Category::where('code', $code)->where('id', '!=', $category->id)->exists()) {
                $category->code = $code . $category->id;
                $category->save();
            }
        });
    
        static::updated(function ($category) {
            Cache::forget('categories_' . $category->code);
        });
    
        static::deleted(function ($category) {
            Cache::forget('categories_' . $category->code);
        });
    }

    /**
     * Function to generate a unique code
     *
     * @return string
     */
    public function generateUniqueCode()
    {
        $baseCode = $this->generateCodeFromName($this->name);

        $code = $baseCode;
        $counter = 1;

        while (Category::where('code', $code)->exists()) {
            $code = $baseCode . '-' . $counter++;
        }

        return $code;
    }

    /**
     * Generate code based on name (customizable)
     *
     * @param string $name
     * @return string
     */
    public function generateCodeFromName($name)
    {
        $initials = '';
        $words = explode(' ', $name);
    
        foreach ($words as $word) {
            $initials .= strtoupper($word[0]);
        }

        $initials = substr($initials, 0, 5);

        $code = $initials . rand(100, 999);

        if (Category::where('code', $code)->exists()) {
            $code = $initials . $this->id;
        }

        return $code;
    }

    /**
     * 
     * 
     * @return string
     */
    public function getUrlAttribute()
    {
        if (isset($this->attributes['url'])) {
            return Str::slug($this->attributes['url']);
        }
    
        return null;
    }

    public function getCached($code)
    {
        if (!$code) {
            return null;
        }

        return Cache::remember('categories_' . $code, config('cache.time', 3600), function () use ($code) {
            return $this->with('children', 'parents')
                ->where('code', $code)
                ->orWhere('url', $code)
                ->orWhereRaw("REPLACE(url, ' ', '-') = ?", [$code])
                ->firstOrFail();
        });
    }

    public function getList($searchName = null)
    {
        if (empty($searchName)) {
            return collect();
        }

        return $this->where('name', 'LIKE', '%' . $searchName . '%')
            ->orderBy('name')
            ->paginate(10);
    }

    public function getPageTitle()
    {
        $title = $this->url . ' - ' . config('app.name');
        $page = request()->query('page', 1);

        if ($page > 1) {
            $title .= ' - Page ' . $page;
        }

        return $title;
    }

    public function getSeoDescription()
    {
        $subcategoryName = $this->children->first()->url ?? '';
        $page = request()->query('page', 1);

        return "Browse our Asian Directory category {$subcategoryName} here on page {$page}. Use our web app or mobile phone app and find what you’re looking for.";
    }
}
