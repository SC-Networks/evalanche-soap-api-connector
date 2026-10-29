<?php

declare(strict_types=1);

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
    public static function get(string $propertyName, ?HydratorConfigInterface $hydratorConfig = null): Closure;

    public static function set(string $propertyName, ?HydratorConfigInterface $hydratorConfig = null): Closure;
}
