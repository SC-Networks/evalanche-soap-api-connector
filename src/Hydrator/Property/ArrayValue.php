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

    /**
     * @param string $propertyName
     *
     * @return Closure
     */
    public static function get(string $propertyName): Closure
    {
        return (new static())->createGetter($propertyName);
    }

    /**
     * @param string $propertyName
     *
     * @return Closure
     */
    private function createGetter(string $propertyName): Closure
    {
        return function () use ($propertyName): ?array {
            return $this->$propertyName;
        };
    }

    /**
     * @param string $propertyName
     *
     * @return Closure
     */
    public static function set(string $propertyName): Closure
    {
        return (new static())->createSetter($propertyName);
    }

    /**
     * @param string $propertyName
     *
     * @return Closure
     */
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

            $this->$propertyName = (array)$items;
        };
    }
}
