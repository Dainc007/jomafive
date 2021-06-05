<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use InvalidArgumentException;

class Article extends Model
{
    //title, slug, content, league(status)
    use HasFactory;

    protected const AVAILABLE_LEAGUES = [
        'Business' => 'business',
        'Weekend'  => 'weekend',
        'Kid'      => 'kid'
    ];

    protected $fillable = [
        'title', 'slug', 'content', 'photoPath', 'photoName', 'league', 'galleryName'
    ];

    public static function getLeague(string $key)
    {
        if (!array_key_exists($key, self::AVAILABLE_LEAGUES)) {
            throw new InvalidArgumentException(sprintf('status for key [%s] does not exist', $key));
        }

        return self::AVAILABLE_LEAGUES[$key];
    }

    public static function getAvailableLeagues(bool $keys = false)
    {
        return ($keys) ? array_keys(self::AVAILABLE_LEAGUES) : array_values(self::AVAILABLE_LEAGUES);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Article $article) {
            $article->slug = $article->title;
        });

        static::updating(function (Article $article) {
            $article->slug = $article->title;
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setSlugAttribute(string $slug)
    {
        $articleSlug = Str::slug($slug);
        $similarSlug = Article::select('slug')
            ->where('slug', 'LIKE', "$articleSlug%")
            ->get();

        if ($similarSlug->isNotEmpty()) {
            $similarCount = $similarSlug->count();
            $articleSlug = Str::slug("{$articleSlug}-{$similarCount}");
        }

        $this->attributes['slug'] = $articleSlug;
    }
    
}
