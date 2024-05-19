<?php

namespace App\Console\Commands;

use App\Models\Good;
use App\Services\ErcPriceService;
use DOMDocument;
use Illuminate\Console\Command;

class ErcPriceCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'erc-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create ERC price';

    /**
     * Execute the console command.
     */
    public function handle(ErcPriceService $ercPriceService)
    {

        $ercPriceService->createXml();
    }

}
