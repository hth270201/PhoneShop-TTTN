<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Product extends Model
{
//    use HasFactory;
    use AsSource;
    use ElasticquentTrait;

    protected $guarded = [];

    protected $casts = [
        'description'          => 'array',
        'payload'    => 'array',
        'thumb'    => 'array',
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

    public function color(){
        return $this->belongsTo(Color::class);
    }
}
