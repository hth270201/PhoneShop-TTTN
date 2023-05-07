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
        'source' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'producer' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'price' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'description' => [
            'type' => 'nested',
            'properties' => [
                'key' => [
                    'type' => 'keyword'
                ],
                'value' => [
                    'type' => 'text'
                ]
            ]
        ],
        'source_url' => [
            'type' => 'text',
            "analyzer" => "standard",
        ]
    );

    /**
     * The elasticsearch settings.
     *
     * @var array
     */
    protected $indexSettings = [
        'analysis' => [
            'char_filter' => [
                'replace' => [
                    'type' => 'mapping',
                    'mappings' => [
                        '&=> and '
                    ],
                ],
            ],
            'filter' => [
                'word_delimiter' => [
                    'type' => 'word_delimiter',
                    'split_on_numerics' => false,
                    'split_on_case_change' => true,
                    'generate_word_parts' => true,
                    'generate_number_parts' => true,
                    'catenate_all' => true,
                    'preserve_original' => true,
                    'catenate_numbers' => true,
                ]
            ],
            'analyzer' => [
                'default' => [
                    'type' => 'custom',
                    'char_filter' => [
                        'html_strip',
                        'replace',
                    ],
                    'tokenizer' => 'whitespace',
                    'filter' => [
                        'lowercase',
                        'word_delimiter',
                    ],
                ],
            ],
        ],
        'mappings' => [
            'products_index' => [
                'properties' => [
                    'name' => [
                        'type' => 'text',
                        "analyzer" => "standard",
                        "include_type_name" => true,
                    ],
                    'slug' => [
                        'type' => 'text',
                        "analyzer" => "standard",
                        "include_type_name" => true,
                    ],
                    'source' => [
                        'type' => 'text',
                        "analyzer" => "standard",
                        "include_type_name" => true,
                    ],
                    'producer' => [
                        'type' => 'text',
                        "analyzer" => "standard",
                        "include_type_name" => true,
                    ],
                    'price' => [
                        'type' => 'integer',
                        "analyzer" => "standard",
                        "include_type_name" => true,
                    ],
                    'description' => [
                        'type' => 'json',
                        "analyzer" => "standard",
                        "include_type_name" => true,
                    ],
                    'source_url' => [
                        'type' => 'text',
                        "analyzer" => "standard",
                    ]
                ],
            ],
        ],
    ];



    public function getIndexName()
    {
        return 'products_index';
    }

    public function getIndexDocumentData()
    {
        return array_merge($this->toArray(), [
            // add additional data here if needed
        ]);
    }
    public function colors(){
        return $this->hasMany(Color::class);
    }
}
