<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'title',
        'description',
        'trailer_url',
        'thumbnail_path',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

