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
        $client = new Client([
            'timeout' => '5.0'
        ]);
        $products = Product::all();
        foreach ($products as $product){
            $this->info('Crawl: '.$this->source.$product->source_url);

            $retry = 2;
            retry:
            try {
                $html = $client->get($this->source.$product->source_url)->getBody()->getContents();
            }catch (\Exception $exception){
                if ($retry >= 0){
                    $retry--;
                    goto retry;
                }
                continue;
            }
            $dom_crawler = new Crawler($html);

            try {
                $config = $dom_crawler->filter('.product-option.version .options .selected span')->text();
            }catch (\Exception $exception){}
            dump($config);
            $thumbs = [];
            $thumb_els = $dom_crawler->filter("a[data-fancybox='gallery']");
            $thumb_els->each(function (Crawler $thumb_el) use (&$thumbs){
               $thumbs[] = $thumb_el->attr('href');
            });
            dump($thumbs);
            $descriptions = [];
            $description_els = $dom_crawler->filter('.specs-special ol li');
            $description_els->each(function (Crawler $description_el) use (&$descriptions){
                $key = $description_el->filter('strong')->text();
                $value = $description_el->filter('span')->text();
                $descriptions[$key] = $value;
            });
            dump($descriptions);
            $details = $dom_crawler->filter('#productContent')->html();
            if (strlen($details) >= 65535) $details = null;
            $rate = $dom_crawler->filter('.display-rating.rating-medium')->attr('data-rate-value');
            if ($rate == "") $rate = 0;
            dump($rate);
            $product = Product::updateOrCreate([
                'slug' => $product->slug
            ], [
                'config' => $config,
                'thumb' => $thumbs,
                'description' => $descriptions,
                'detail' => $details,
                'rate' => $rate
            ]);
            $color_els = $dom_crawler->filter('#colorOptions .item');
            $color_els->each(function (Crawler $color_el) use (&$color_id,$product){
                $color_name = $color_el->attr('data-name');
                $color_price = preg_replace('/[^0-9]/', "", $color_el->attr('data-bestprice'));
                $color_code = $color_el->attr('data-hex');
                $color = new Color();
                $color->color = $color_name;
                $color->color_code = $color_code;
                $color->price = $color_price;
                $color->product_id = $product->id;
                $color->save();
            });
        }
        return Command::SUCCESS;
    }
}
