<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

/**
 * App\Models\Product
 * @mixin Builder
 */
class Product extends Model
{
    use HasFactory;
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
        ]
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
