<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Closure;
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
     * @param HydratorConfigInterface|null $hydratorConfig
     * @return Closure
     */
    public static function get(string $propertyName, ?HydratorConfigInterface $hydratorConfig = null): Closure;

    /**
     * @param string $propertyName
     * @param HydratorConfigInterface|null $hydratorConfig
     * @return Closure
     */
    public static function set(string $propertyName, ?HydratorConfigInterface $hydratorConfig = null): Closure;
}
