<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleReviewsService
{
  protected $apiKey;
  protected $placeId;

  public function __construct()
  {
    $this->apiKey = config('services.google.api_key');
    $this->placeId = config('services.google.place_id');
  }

  public function fetchReviews()
  {
    $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
      'place_id' => $this->placeId,
      'fields' => 'reviews',
      'key' => $this->apiKey,
    ]);

    if (!$response->successful()) {
      return [];
    }

    return $response->json('result.reviews') ?? [];
  }
}
