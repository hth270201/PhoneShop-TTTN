<?php

namespace App\Orchid\Screens\Product;

use App\Libs\StringUtils;
use App\Models\Product;
use App\Orchid\Layouts\Product\ProductFilterLayout;
use App\Orchid\Layouts\Product\ProductListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use function React\Promise\all;

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
            $keys = $request->input('key');
            $keys = StringUtils::normalize($keys);
            $keys = explode(" ", $keys);

            $query_string = [
                'bool' => [
                    'should' => [],
                    'minimum_should_match' => count($keys)
                ]
            ];

            foreach ($keys as $key){
                $query_string['bool']['should'][] = ['match' => ['name' => $key]];
            }

            $products = Product::searchByQuery($query_string)->toQuery()->paginate();
//            dd($products);
        }
        return [
            'products' => $products ?? Product::all()
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
