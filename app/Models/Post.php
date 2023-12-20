<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'content', 'price', 'category_id', 'user_id', 'img' ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function usersRated(){
        return $this->belongsToMany(User::class)
            ->withPivot('rating')->withTimestamps();
    }

    public function usersBought(){
        return $this ->belongsToMany(User::class, 'cart')
            ->withTimestamps()
            ->withPivot('quantity', 'status');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
