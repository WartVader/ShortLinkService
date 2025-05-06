<?php

namespace Tests;

use App\Services\ShortLinkService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;
    protected string $slugTest = 'test';
    protected ShortLinkService $shortLinkService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->shortLinkService = app(ShortLinkService::class);
    }

}
