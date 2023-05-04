<?php

namespace App\Console\Commands\Crawler;

use App\Models\Color;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class DetailCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:detail';
    protected $source = "https://hoanghamobile.com";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $products = Product::all();
        foreach ($products as $product){
            $this->info('Crawl: '.$this->source.$product->source_url);
            $html = $client->get($this->source.$product->source_url)->getBody()->getContents();
            $dom_crawler = new Crawler($html);

            $config = $dom_crawler->filter('.product-option.version .options .selected span')->text();

            $thumbs = [];
            $thumb_els = $dom_crawler->filter("a[data-fancybox='gallery']");
            $thumb_els->each(function (Crawler $thumb_el) use (&$thumbs){
               $thumbs[] = $thumb_el->attr('href');
            });

            $color_els = $dom_crawler->filter('#colorOptions .item');
            $color_id = null;
            $color_els->each(function (Crawler $color_el) use (&$color_id){
                $color_name = $color_el->attr('data-name');
                $color_price = preg_replace('/[^0-9]/', "", $color_el->attr('data-bestprice'));
                $color_code = $color_el->attr('data-hex');
                $color = Color::updateOrCreate(
                    [
                        'color' => $color_name,
                    ],
                    [
                        'color' => $color_name,
                        'price' => $color_price,
                        'color_code' => $color_code
                    ]
                );
                if ($color_el->attr('class') == "item selected"){
                    $color_id = $color->id;
                }
            });

        }
        return Command::SUCCESS;
    }
}
