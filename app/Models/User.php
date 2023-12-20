<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'image',
        'shot'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function postsRated(){
        return $this->belongsToMany(Post::class)
            ->withPivot('rating')->withTimestamps();
    }

    public function postsBought(){
        return $this ->belongsToMany(Post::class, 'cart')
            ->withTimestamps()
            ->withPivot('quantity', 'status')
            ->withTimestamps();
    }

    public function postsWithStatus($status){
        return $this->belongsToMany(Post::class, 'cart')
            ->wherePivot('status', $status)
            ->withTimestamps()
            ->withPivot('quantity', 'status', 'sum', 'kol');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
