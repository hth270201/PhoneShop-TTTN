<?php
namespace App\Enum;

use Spatie\Enum\Enum;

class CrawlStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'SUCCESS' => '1',
            'ERROR' => '-1',
            'PENDING' => '0'
        ];
    }
    public static function getLabel($key)
    {
        $values = static::values();
        return isset($values[$key]) ? $values[$key] : null;
    }

    public static function search($value): ?string
    {
        $values = static::values();

        $key = array_search($value, $values);
        if ($key !== false) {
            return $key;
        }

        return null;
    }


}
