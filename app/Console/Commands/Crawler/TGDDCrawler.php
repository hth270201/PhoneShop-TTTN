<?php

namespace App\Console\Commands\Crawler;

use App\Enum\ProducerEnum;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class TGDDCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:cellphones
    {--producer= : iphone, samsung, xiaomi, ....}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawler phone from CellPhoneS';

    protected $source = 'https://cellphones.com.vn/mobile/__PRODUCER__.html';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $producer = $this->option('producer');
        $producer = ProducerEnum::getLabel($producer);

        $url = str_replace("__PRODUCER__", $producer, $this->source);

        $client = new Client();
        $response = $client->get($url);
        $html = $response->getBody()->getContents();

        $dom_crawler = new Crawler($html);
        $list_products = $dom_crawler->filter('.product-list-filter > .product-info-container.product-item');
        $list_products->each(function (Crawler $product) use ($producer){
            $name = $product->filter('.product__name > h3')->text();
            $slug = Str::slug($name);
            $this->info("Crawl: $slug data");
            $price = $product->filter('.product__price--show')->text();
            $source = $product->filter('.product__link')->attr('href');
            $product = Product::firstOrCreate([
                'slug' => $slug
            ], [
                'name' => $name,
                'slug' => $slug,
                'source' => $source,
                'producer' => $producer,
            ]);
        });

        $typeExists = Product::typeExists();
        Product::reindex();
        return Command::SUCCESS;
    }


}
