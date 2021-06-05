<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'surname', 'email', 'phoneNumber', 'updated_at' , 'created_at'
    ];

    public function team()
    {
       return  $this->belongsTo(Team::class);
    }
}
