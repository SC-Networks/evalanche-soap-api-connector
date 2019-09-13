<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

/**
 * Class FloatValue
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
final class FloatValue implements PropertyInterface
{
    /**
     * @param string $propertyName
     *
     * @return \Closure
     */
    public static function get(string $propertyName): \Closure
    {
        return (new static())->createGetter($propertyName);
    }

    /**
     * @param string $propertyName
     *
     * @return \Closure
     */
    private function createGetter(string $propertyName): \Closure
    {
        return function () use ($propertyName): ?float {
            return $this->$propertyName;
        };
    }

    /**
     * @param string $propertyName
     *
     * @return \Closure
     */
    public static function set(string $propertyName): \Closure
    {
        return (new static())->createSetter($propertyName);
    }

    /**
     * @param string $propertyName
     *
     * @return \Closure
     */
    private function createSetter(string $propertyName): \Closure
    {
        return function ($value) use ($propertyName): void {
            $this->$propertyName = (float)$value;
        };
    }
}
