<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Closure;

/**
 * Interface PropertyInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
interface PropertyInterface
{
    /**
     * @param string $propertyName
     *
     * @return Closure
     */
    public static function get(string $propertyName): Closure;

    /**
     * @param string $propertyName
     *
     * @return Closure
     */
    public static function set(string $propertyName): Closure;
}
