<?php

namespace App\Models;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property int|null $price
 * @property string|null $config
 * @property array $thumb
 * @property array $description
 * @property string|null $detail
 * @property string|null $producer
 * @property float|null $rate
 * @property int|null $comment_id
 * @property int|null $review_id
 * @property array $payload
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $source_url
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Color> $colors
 * @property-read int|null $colors_count
 * @method static \Elasticquent\ElasticquentCollection<int, static> all($columns = ['*'])
 * @method static \Elasticquent\ElasticquentCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereConfig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProducer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSourceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
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
