<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Closure;

/**
 * Class ArrayValue
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
final class ArrayValue implements PropertyInterface
{
    public static function get(string $propertyName): Closure
    {
        return (new static())->createGetter($propertyName);
    }

    private function createGetter(string $propertyName): Closure
    {
        return fn (): ?array => $this->$propertyName;
    }

    public static function set(string $propertyName): Closure
    {
        return (new static())->createSetter($propertyName);
    }

    private function createSetter(string $propertyName): Closure
    {
        return function ($value) use ($propertyName): void {
            $items = [];

            if (isset($value->item)) {
                if (!is_array($value->item)) {
                    $items = [$value->item];
                } else {
                    $items = $value->item;
                }
            }

            $this->$propertyName = $items;
        };
    }
}
