<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductFilterLayout;
use App\Orchid\Layouts\Product\ProductListLayout;
use Orchid\Screen\Screen;

class ProductListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        dd(Product::searchByQuery(['match' => ['name' => 'iphone']]));
        return [
            'products' => Product::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ProductListScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ProductFilterLayout::class,
            ProductListLayout::class
        ];
    }
}
