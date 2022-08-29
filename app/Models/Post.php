<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','user_id'];

    // public function comment(){
    //     return $this->hasMany(Comment::class);
    // }

    public function comment(){
        return $this->morphMany('App\Models\Comment','commentable');
    }

    public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comment')->orderBy('comment_count','desc');
    }
    
    public static function boot(){
        parent::boot();
        static::addGlobalScope(new LatestScope);
        static::deleting(function(Post $post){
            $post->comment()->delete();
        });
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->morphToMany('\App\Models\Tag','taggable')->withTimestamps();
    }
}
