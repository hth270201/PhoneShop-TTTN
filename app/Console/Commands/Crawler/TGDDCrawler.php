<?php

namespace App\Console\Commands\Crawler;

use App\Enum\CrawlStatusEnum;
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
    protected $signature = 'crawler:tgdd
    {--producer= : iphone, samsung, xiaomi, ....}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawler phone from TGDD';

    protected $source = 'https://www.thegioididong.com/dtdd-__PRODUCER__';

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
        $list_products = $dom_crawler->filter('.listproduct > .item > .main-contain');
        $list_products->each(function (Crawler $product) use ($producer){
            $name = $product->filter('h3')->text();
            $slug = Str::slug($name);
            $this->info("Crawl: $slug data");
            $config_els = $product->filter('.prods-group > ul > li');
            $price = $product->filter('.price')->text();
            $price_with_config = [];
            $config_els->each(function (Crawler $config_el, $i=0) use (&$price_with_config, $price){
                $config = $config_el->text();
                if ($i==0){
                    $price_with_config[$config] = $price;
                }else{
                    $price_with_config[$config] = 0;
                }
            });
            $source = $product->attr('href');


            $product = Product::firstOrCreate([
                'slug' => $slug
            ], [
                'name' => $name,
                'slug' => $slug,
                'price_with_config' => $price_with_config,
                'crawl_status' => CrawlStatusEnum::getLabel('PENDING'),
                'source' => $source,
                'producer' => $producer
            ]);
        });


        return Command::SUCCESS;
    }


}
