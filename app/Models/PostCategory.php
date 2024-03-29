<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function postSubcategories()
    {
        return $this->hasMany(PostSubcategory::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
