<?php

namespace App\Services;

use App\Models\Listing;

class ListingAnalyticsService
{
    /**
     * Record a view for the given listing.
     *
     * When this function is called, it increments the views_count.
     * 
     * @param Listing $listing
     * @return void
     */
    public static function recordView(Listing $listing): void
    {
        $listing->increment('views_count');
    }

    /**
     * Record a message for the given listing.
     *
     * When this function is called, it increments the messages_count.
     * 
     * @param Listing $listing
     * @return void
     */
    public static function recordMessage(Listing $listing): void
    {
        $listing->increment('messages_count');
    }

    /**
     * Retrieve the hottest listings based on views and messages.
     *
     * Hottest listings are determined by the highest views_count and messages_count.
     * 
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function hotListings(int $limit = 5)
    {
        return Listing::orderByDesc('views_count')
            ->orderByDesc('messages_count')
            ->limit($limit)
            ->get();
    }
}
