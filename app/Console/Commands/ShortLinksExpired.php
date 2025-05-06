<?php

namespace App\Console\Commands;

use App\Models\ShortLink;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ShortLinksExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'short-links:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all expired links';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredLinks = ShortLink::query()->where('expires_at', '<=', now())->get();
        $count = $expiredLinks->count();
        $expiredLinks->toQuery()->delete();

        $this->info("Deleted $count links.");
        return 0;
    }
}
