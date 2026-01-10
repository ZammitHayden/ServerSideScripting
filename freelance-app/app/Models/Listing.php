<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'category_id', 'title', 'slug', 'description', 'price', 'email', 'views_count', 'messages_count',
    ];

    protected static function booted()
    {
        static::creating(function ($listing) {
            $listing->slug = Str::slug($listing->title);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

