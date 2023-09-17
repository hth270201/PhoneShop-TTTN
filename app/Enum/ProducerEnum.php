<?php
namespace App\Enum;

use Spatie\Enum\Enum;

class ProducerEnum extends Enum
{
    public static function values(): array
    {
        return [
            'iphone' => 'iphone',
            'samsung' => 'samsung',
            'oppo' => 'oppo',
            'xiaomi' => 'xiaomi',
            'vivo' => 'vivo',
            'realme' => 'realme',
            'tcl' => 'tcl',
            'bphone' => 'bphone',
            'masstel' => 'masstel',
            'nokia' => 'nokia'
        ];
    }
    public static function getLabel($key)
    {
        $values = static::values();
        return isset($values[$key]) ? $values[$key] : null;
    }

}
