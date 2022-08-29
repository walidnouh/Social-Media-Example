<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot(){
        parent::boot();
        static::addGlobalScope(new LatestScope);
    }

    public function comment(){
        return $this->morphMany('App\Models\Comment','commentable');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }

    public function scopeUsersActive(Builder $query)
    {
        return $query->withCount('posts')->orderBy('posts_count','desc');           
    }

    public function scopeUserActiveInLastMonth(Builder $query)
    {
        return $query->withCount(['posts'=>function(Builder $query){
            $query->whereBetween(static::CREATED_AT,[now()->subMonths(1),now()]);
        }])->orderBy('posts_count','desc');
    }
}

