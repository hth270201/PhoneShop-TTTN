<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory;
    use AsSource;

    protected $guarded = [];

    protected $casts = [
        'price_with_color'          => 'array',
        'price_with_config'    => 'array',
        'thumb'    => 'array',
        'details'    => 'array',
    ];
}
