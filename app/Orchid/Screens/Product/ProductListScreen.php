<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use App\Orchid\Layouts\Product\ProductFilterLayout;
use App\Orchid\Layouts\Product\ProductListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;

class ProductListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request): iterable
    {
        if ($request->input('key')){
            dd($request->input('key'));
        }
//        dd(Product::searchByQuery([
//            'bool' => [
//                'should' => [
//                    ['match' => ['name' => 'Xiaomi']],
//                    ['match' => ['name' => '12GB']],
//                    ['match' => ['name' => '256GB']],
//                    ['match' => ['producer' => 'xiaomi']]
//                ],
//                'minimum_should_match' => 4
//            ],
//        ]));
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
