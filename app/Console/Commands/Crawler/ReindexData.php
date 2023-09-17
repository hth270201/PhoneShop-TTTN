<?php

namespace App\Console\Commands\Crawler;

use App\Models\Product;
use Illuminate\Console\Command;

class ReindexData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $product = Product::all();
        Product::reindex();
        return Command::SUCCESS;
    }
}
