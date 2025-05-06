<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;

class ShortLinkTest extends TestCase
{
    protected string $randomSlugString;
    protected string $destination = 'https://www.google.com/?hl=ru';
    protected string $inactiveDestination;

    protected function setUp(): void
    {
        parent::setUp();
        $this->randomSlugString = Str::random(config('shortlink.maxLength'));
        $this->inactiveDestination = url('/this/is/inactive/route');
    }

    protected function requestCreateShortLink($destination = null): \Illuminate\Testing\TestResponse
    {
        return $this->post('/api/short-link',
            [
                'destination_url' => $destination ?? $this->destination,
                'slug' => $this->randomSlugString,
                'ttl_days' => 30,
            ],
            [
                'Authorization' => "Bearer " . config('shortlink.token'),
            ]
        );
    }

    /**
     * A basic feature test example.
     */
    public function testShortLinkCreation(): void
    {
        $response = $this->requestCreateShortLink();

        $response->assertStatus(201);
    }

    public function testRedirect(): void
    {
        $this->requestCreateShortLink();
        $response = $this->get("/".$this->randomSlugString);
        $redirect = $this->destination;

        $response->assertRedirect($redirect);
    }

    public function testNotFoundRedirect(): void
    {
        $response = $this->get("/$this->randomSlugString");
        $redirect = config('shortlink.redirectNotFound');

        $response->assertRedirect($redirect);
    }

    public function testInactiveRedirect(): void
    {
        $this->requestCreateShortLink($this->inactiveDestination);
        $response = $this->get("/$this->randomSlugString");
        $redirect = config('shortlink.redirectInactive');

        $response->assertRedirect($redirect);
    }

}
