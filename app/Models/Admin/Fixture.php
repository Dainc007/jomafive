<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'hosts', 'visitors', 'hosts_goals', 'visitors_goals', 'date', 'hour', 'pitch', 'competitionID'
    ];

    protected $guarded = [];
}
