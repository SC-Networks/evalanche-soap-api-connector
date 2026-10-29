<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Closure;

/**
 * Interface PropertyInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
interface PropertyInterface
{
    public static function get(string $propertyName): Closure;

    public static function set(string $propertyName): Closure;
}
