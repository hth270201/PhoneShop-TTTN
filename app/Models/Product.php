<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory;
    use AsSource;
    use ElasticquentTrait;

    protected $guarded = [];

    protected $casts = [
        'price_with_color'          => 'array',
        'price_with_config'    => 'array',
        'thumb'    => 'array',
        'details'    => 'array',
    ];

    protected $mappingProperties = array(
        'name' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'slug' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'source ' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'producer' => [
            'type' => 'text',
            "analyzer" => "standard",
        ]
    );
}
