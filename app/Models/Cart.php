<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Cart extends Model
{

    protected $table = 'carts';

    protected $guarded = [];

    protected $casts = [
        'content' => 'array'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
