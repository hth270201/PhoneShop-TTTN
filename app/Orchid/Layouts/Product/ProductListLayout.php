<?php

namespace App\Orchid\Layouts\Product;

use App\Enum\CrawlStatusEnum;
use App\Models\Product;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID'),
            TD::make('name', 'Name'),
            TD::make('price_with_config', 'Price with config')
                ->render(function (Product $product){
                    $price_with_configs = $product->price_with_config;
                    $dom = "";
                    foreach ($price_with_configs as $config => $price){
                        $dom .= "<span class='text-danger'>$config: </span>$price <br>";
                    }
                    return $dom;
                }),
            TD::make('source', 'Source'),
            TD::make('crawl-status', 'Crawl status')
                ->render(function (Product $product){
                    return CrawlStatusEnum::search($product->crawl_status);
                })
        ];
    }
}
