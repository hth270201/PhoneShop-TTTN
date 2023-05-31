<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Color
 *
 * @property int $id
 * @property string $color
 * @property int|null $product_id
 * @property string|null $color_code
 * @property int|null $price
 * @property int $count
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|Color newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Color query()
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereColorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Color whereUpdatedAt($value)
 * @mixin Builder
 */
class Color extends Model
{

    protected $table = 'colors';

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
