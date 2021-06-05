<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuniorTeam extends Model
{
    protected $fillable = [
        'nickname', 'shieldPath', 'teamPhotoPath'
    ];


    use HasFactory;
}
