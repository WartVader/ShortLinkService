<?php

namespace App\Services;

use App\Models\ShortLink;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ShortLinkService
{
    /**
     * @param array $data
     * @return ShortLink
     */
    public function create(array $data): ShortLink
    {
        $data['expires_at'] = Carbon::now()->addDays($data['ttl_days'] ?? config('shortlink.defaultTtlDays'));
        /** @var ShortLink $shortLink */
        $shortLink = ShortLink::create($data);

        return $shortLink;
    }

    /**
     * @param $slug
     * @return string
     */
    public function getRedirectUrl($slug): string
    {
        $shortLink = ShortLink::query()->select('destination_url')->where('slug', $slug)->first();

        if (!$shortLink) {
            return config('shortlink.redirectNotFound');
        }

        try {
            $response = Http::timeout(5)
                ->connectTimeout(1)
                ->head($shortLink->destination_url);

            if (!$response->successful()) {
                return config('shortlink.redirectInactive');
            }

        } catch (\Exception $e) {
            return config('shortlink.redirectInactive');
        }

        return $shortLink->destination_url;
    }
}
