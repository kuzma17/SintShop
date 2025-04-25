<?php

namespace App\Console\Commands;

use App\Services\SiteMapService;
use Illuminate\Console\Command;

class SiteMapGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site-map';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SiteMapService $siteMapService)
    {
        $siteMapService->generateMap();

        $this->info('=== Complete ===');
    }
}
