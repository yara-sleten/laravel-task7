<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use SoftDeletes;
    protected $data=['deleted_at'];
    protected $fillable=[
        'title',
        'content',
        'image'
    ];
    public function categories(){
        return $this->belongsToMany(Category::class,'blog_category');
    }
    
}

