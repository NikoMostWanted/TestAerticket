<?php
declare(strict_types=1);

namespace App\Constant;

abstract class BaseConstant
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getConstants() : array
    {
        return array_values((new \ReflectionClass(static::class))->getConstants());
    }
}