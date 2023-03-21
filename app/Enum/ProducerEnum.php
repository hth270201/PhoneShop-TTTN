<?php
namespace App\Enum;

use Spatie\Enum\Enum;

class ProducerEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'iphone' => 'apple',
            'samsung' => 'samsung',
            'oppo' => 'oppo',
            'xiaomi' => 'xiaomi',
            'vivo' => 'vivo',
            'realme' => 'realme',
            'asus' => 'asus',
            'oneplus' => 'oneplus',
        ];
    }
    public static function getLabel($key)
    {
        $values = static::values();
        return isset($values[$key]) ? $values[$key] : null;
    }

}
