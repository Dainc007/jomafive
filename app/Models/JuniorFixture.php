<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuniorFixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'hosts', 'visitors', 'hosts_goals', 'visitors_goals', 'date', 'hour', 'group', 'pitch', 'competitionID', 'stage'
    ];
}
