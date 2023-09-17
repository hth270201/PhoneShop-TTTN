<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Order extends Model
{
    protected $table = 'orders';

    protected $guarded = [];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
