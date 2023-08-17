<?php
namespace App\Traits;

trait EnumTrait{

    public static function getEnumValues(){
        $reflection = new \ReflectionClass(static::class);
        return $reflection->getConstants();
    }
   
    public static function isValidEnumValue($value):bool{
        return in_array($value, static::getEnumValues(), true);
    }

}