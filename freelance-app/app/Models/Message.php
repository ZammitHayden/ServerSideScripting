<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'listing_id',
        'sender_email',
        'message'
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}

