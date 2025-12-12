<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Favorite extends Model
{
    protected $fillable = ['user_id', 'blog_id'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}

