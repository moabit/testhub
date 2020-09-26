<?php
declare(strict_types=1);

namespace App\DTO;


abstract class DataTransferObject
{
    public function __construct(array $params)
    {
        $refClass = new \ReflectionClass(static::class);
        foreach ($refClass->getProperties(\ReflectionProperty::IS_PUBLIC) as $refProperty) {
            $property = $refProperty->getName();
            $this->{$property} = $params[$property];
        }
    }
}

