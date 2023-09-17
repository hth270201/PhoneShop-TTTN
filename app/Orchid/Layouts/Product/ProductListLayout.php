<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
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
            TD::make('id', 'ID')->width(80),
            TD::make('name', 'Name')
                ->render(function (Product $product){
                    return Link::make($product->name)->route('shop.product.edit', $product);
                })
                ->width(400),
            TD::make('price', 'Price')
                ->render(function (Product $product){
                    return number_format($product->price);
                })->width(100),
            TD::make('config', 'Config')->width(100),
            TD::make('producer', 'Producer')->width(100),
            TD::make('color', 'Color')
                ->render(function (Product $product){
                    $colors = $product->colors()->get();
                    $html = "";
                    foreach ($colors as $color){
                        $html .= "<span style='color: red'>".$color->color.": </span>". number_format($color->price)."<br>";
                    }
                    return $html;
                }),
            TD::make('description', 'Description')
                ->render(function (Product $product){
                    $html = "";
                    foreach ($product->description as $key => $value){
                        $html .= "<b>$key: </b>$value<br>";
                    }
                    return $html;
                })->width(500),
//            TD::make('created_at', 'Created At'),
//            TD::make('updated_at', 'Updated At')
        ];
    }
}
