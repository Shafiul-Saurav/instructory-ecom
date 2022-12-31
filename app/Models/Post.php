<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'pcategory_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(PostSubcategory::class, 'subcategory_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', 1);
    }
}
