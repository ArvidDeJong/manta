<?php

namespace Darvis\Manta\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\RequestException;

class GoogleGeocodeService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://maps.googleapis.com/maps/api/geocode/json';

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_KEY_PHP');
    }

    /**
     * Get coordinates for an address
     */
    public function getCoordinates(string $address): ?array
    {
        $cacheKey = 'geocode_' . md5($address);

        return Cache::remember($cacheKey, now()->addDays(30), function () use ($address) {
            try {
                $response = Http::get($this->baseUrl, [
                    'address' => $address,
                    'key' => $this->apiKey
                ]);

                $response->throw();

                if ($response->json('status') === 'OK') {
                    $result = $response->json('results')[0];
                    return $this->formatGeocodeResult($result);
                }

                return null;
            } catch (RequestException $e) {
                logger()->error('Geocoding error:', [
                    'address' => $address,
                    'error' => $e->getMessage()
                ]);
                return null;
            }
        });
    }

    /**
     * Get address for coordinates
     */
    public function getAddress(float $latitude, float $longitude): ?array
    {
        $cacheKey = 'reverse_geocode_' . md5("{$latitude},{$longitude}");

        return Cache::remember($cacheKey, now()->addDays(30), function () use ($latitude, $longitude) {
            try {
                $response = Http::get($this->baseUrl, [
                    'latlng' => "{$latitude},{$longitude}",
                    'key' => $this->apiKey
                ]);

                $response->throw();

                if ($response->json('status') === 'OK') {
                    $result = $response->json('results')[0];
                    return $this->formatGeocodeResult($result);
                }

                return null;
            } catch (RequestException $e) {
                logger()->error('Reverse geocoding error:', [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'error' => $e->getMessage()
                ]);
                return null;
            }
        });
    }

    /**
     * Get address suggestions for autocomplete
     */
    public function getAddressSuggestions(string $input): array
    {
        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/place/autocomplete/json', [
                'input' => $input,
                'key' => $this->apiKey,
                'types' => 'address'
            ]);

            $response->throw();

            if ($response->json('status') === 'OK') {
                return collect($response->json('predictions'))
                    ->map(fn($prediction) => [
                        'description' => $prediction['description'],
                        'place_id' => $prediction['place_id']
                    ])
                    ->all();
            }

            return [];
        } catch (RequestException $e) {
            logger()->error('Address autocomplete error:', [
                'input' => $input,
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * Format geocoding result
     */
    protected function formatGeocodeResult(array $result): array
    {
        $location = $result['geometry']['location'];
        $components = collect($result['address_components'])->keyBy('types.0');

        return [
            'latitude' => $location['lat'],
            'longitude' => $location['lng'],
            'formatted_address' => $result['formatted_address'],
            'street_number' => $components->get('street_number')['long_name'] ?? '',
            'route' => $components->get('route')['long_name'] ?? '',
            'locality' => $components->get('locality')['long_name'] ?? '',
            'country' => $components->get('country')['long_name'] ?? '',
            'postal_code' => $components->get('postal_code')['long_name'] ?? '',
        ];
    }
}
