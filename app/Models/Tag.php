<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public function posts(){
        return $this->morphByMany('App\Models\Post','taggable')->withTimestamps();
    }

    public function comments(){
        return $this->morphByMany('App\Models\Comment','taggable')->withTimestamps();
    }
}
