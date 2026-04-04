<?php

namespace App\Jobs;

use App\Models\GoogleReview;
use App\Services\GoogleReviewsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GoogleReviews implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(GoogleReviewsService $service)
    {
        $reviews = $service->fetchReviews();
        \Log::info('GoogleReviews job ran');
        foreach ($reviews as $review) {
            $author = $review['author_name'] ?? null;
            $time   = $review['time'] ?? null;

            if (!$author || !$time) {
                continue;
            }

            $googleHash = md5($author . $time);

            GoogleReview::updateOrCreate(
                ['google_hash' => $googleHash],
                [
                    'author_name'       => $author,
                    'rating'            => $review['rating'] ?? null,
                    'text'              => trim(preg_replace('/\n+/', "\n", $review['text'] ?? '')),
                    'profile_photo_url' => $review['profile_photo_url'] ?? null,
                    'review_time'       => now()->setTimestamp($time),
                ]
            );
        }
    }
}
