<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'thumbnail', 'title', 'slug', 'sub_title', 'details', 'post_type', 'is_published'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_posts');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', '1');
    }

    public function scopeIsPage($query) 
    {
        return $query->where('post_type', 'page');
    }
}
