<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;

/**
 * Interface PropertyObjectInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
interface PropertyObjectInterface
{
    /**
     * @param string $propertyName
     *
     * @return \Closure
     */
    public static function get(string $propertyName): \Closure;

    /**
     * @param string $propertyName
     *
     * @param HydratorConfigInterface $hydratorConfig
     * @return \Closure
     */
    public static function set(string $propertyName, HydratorConfigInterface $hydratorConfig = null): \Closure;
}
