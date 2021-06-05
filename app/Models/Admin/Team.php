<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected const AVAILABLE_LEAGUES = [
        'Business' => 'business',
        'Weekend'  => 'weekend',
    ];

    protected $fillable = [
        'name', 'shieldPath', 'teamPhotoPath'
    ];

    public static function getAvailableLeagues(bool $keys = false)
    {
        return ($keys) ? array_keys(self::AVAILABLE_LEAGUES) : array_values(self::AVAILABLE_LEAGUES);
    }

    public function manager()
    {
       return $this->hasOne(Manager::class);
    }

}
