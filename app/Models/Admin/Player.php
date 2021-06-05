<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'shield', 'yearOfBirth', 'name', 'surname', 'teamName', 'teamID', 'confirmed'
    ];
}
