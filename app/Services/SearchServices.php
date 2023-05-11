<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class SearchServices
{
    public static function elasticSearch($keys){
        $query_string = [
            'bool' => [
                'should' => [],
                'minimum_should_match' => count($keys)
            ]
        ];

        foreach ($keys as $key){
            $query_string['bool']['should'][] = [
                'fuzzy' => [
                    'name' => [
                        'value' => $key,
                        'fuzziness' => 'AUTO',
                        'prefix_length' => 1
                    ],
                ]
            ];
        }

        $products = Product::searchByQuery($query_string);
        if (count($products) == 0){
            return false;
        }
        return  $products->toQuery();
    }

    public static function where($keys){
        return Product::where('name', 'LIKE', '%'.$keys.'%');
    }
}
