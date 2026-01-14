<?php

namespace App\Services;

use App\Models\Listing;

class ListingAnalyticsService
{
    public static function recordView(Listing $listing): void
    {
        $listing->increment('views_count');
    }

    public static function recordMessage(Listing $listing): void
    {
        $listing->increment('messages_count');
    }

    public static function hotListings(int $limit = 5)
    {
        return Listing::orderByDesc('views_count')
            ->orderByDesc('messages_count')
            ->limit($limit)
            ->get();
    }
}
