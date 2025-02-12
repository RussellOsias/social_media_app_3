<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'posts'; 

    // Specify the fillable attributes
    protected $fillable = ['user_id', 'content'];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the Comment model
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Define the relationship to the Like model
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Accessor for the likes count
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
