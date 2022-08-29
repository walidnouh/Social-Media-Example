<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = ['content','user_id'];

    
    public function Post(){
      return  $this->hasOne(Post::class);
    }

    public function tags(){
      return $this->morphToMany('\App\models\Tag','taggable')->withTimestamps();
    }

    public function commentable(){
      return $this->morphTo();
    }

    public function user(){
      return  $this->belongsTo(User::class);
    }

}
