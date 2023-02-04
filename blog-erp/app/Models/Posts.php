<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Posts extends Model
{
    protected $guarded =[''];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::of($post->title)->slug('-');
        });
    }
}
