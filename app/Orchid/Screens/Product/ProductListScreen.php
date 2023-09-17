<?php

namespace App\Orchid\Screens\Product;

use App\Libs\StringUtils;
use App\Models\Product;
use App\Orchid\Layouts\Product\ProductFilterLayout;
use App\Orchid\Layouts\Product\ProductListLayout;
use App\Services\SearchServices;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use function React\Promise\all;

class ProductListScreen extends Screen
{
    /**
     * @var Product
     */
    public $product;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request): iterable
    {
        $search_engine = $request->input('search_engine');
        if ($request->input('key') && $request->input('search_engine')){
            $keys = $request->input('key');
            $keys = StringUtils::normalize($keys);
            $keys = explode(" ", $keys);

            if ($search_engine == 'elastic'){
                $products = SearchServices::elasticSearch($keys);
                if (!$products){
                    $products = [];
                    goto next;
                }
            }elseif ($search_engine == 'where'){
                $products = SearchServices::where($keys);
            }else{
                $products = SearchServices::fullText($keys)->limit(10);
            }
            $products = $products->paginate(30);
        }else{
            $products = Product::paginate(30);
        }
        next:
        return [
            'products' => $products
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
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('shop.product.edit')
        ];
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
