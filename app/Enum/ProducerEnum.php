<?php
namespace App\Enum;

use Spatie\Enum\Enum;

class ProducerEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'iphone' => 'apple-iphone',
            'samsung' => 'samsun',
            'oppo' => 'oppo',
            'xiaomi' => 'xiaomi',
            'vivo' => 'vivo',
            'realmi' => 'realmi',
            'nokia' => 'nokia',
            'TCL' => 'tcl',
            'masstel' => 'masstel',
        ];
    }
    public static function getLabel($key)
    {
        $values = static::values();
        return isset($values[$key]) ? $values[$key] : null;
    }

}
