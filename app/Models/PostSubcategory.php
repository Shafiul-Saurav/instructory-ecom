<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostSubcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'pcategory_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
