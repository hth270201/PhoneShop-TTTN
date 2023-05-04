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
    protected $signature = 'crawler:hhmobile
    {--producer= : iphone, samsung, xiaomi, ....}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawler phone from HoangHaMobile';

    protected $source = 'https://hoanghamobile.com/dien-thoai-di-dong/__PRODUCER__';

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
        $response = $client->get($url)->getBody()->getContents();

        $dom_crawler = new Crawler($response);
        $list_products = $dom_crawler->filter('.col-content.lts-product .item');
        $list_products->each(function (Crawler $product) use ($producer, $client){
            $name = $product->filter('.title')->text();
            $slug = Str::slug($name);
            $this->info("Crawl: $slug data");
            $price = preg_replace('/[^0-9]/', "", $product->filter('.price strong')->text());
            $source_url = $product->filter('.title')->attr('href');

            $product = Product::firstOrCreate([
                'slug' => $slug
            ], [
                'name' => $name,
                'slug' => $slug,
                'producer' => $producer,
                'price' => $price,
                'source_url' => $source_url
            ]);
        });

        $typeExists = Product::typeExists();
        Product::reindex();
        return Command::SUCCESS;
    }


}
