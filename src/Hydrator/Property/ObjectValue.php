<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Closure;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\Hydrator\Hydrator;

/**
 * Class ObjectValue
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
final class ObjectValue implements PropertyObjectInterface
{
    public static function get(string $propertyName, ?HydratorConfigInterface $hydratorConfig = null): Closure
    {
        return (new static())->createGetter($propertyName);
    }

    private function createGetter(string $propertyName): Closure
    {
        return fn (): ?object => $this->$propertyName;
    }

    public static function set(string $propertyName, ?HydratorConfigInterface $hydratorConfig = null): Closure
    {
        return (new static())->createSetter($propertyName, $hydratorConfig);
    }

    private function createSetter(string $propertyName, ?HydratorConfigInterface $hydratorConfig = null): Closure
    {
        return function ($value) use ($propertyName, $hydratorConfig): void {
            if ($hydratorConfig instanceof HydratorConfigInterface) {
                $hydrator = new Hydrator();

                $object = $hydratorConfig->getObject();

                $hydrator->hydrate(
                    $hydratorConfig,
                    $object,
                    (array)$value,
                    Hydrator::NO_STRICT_KEYS
                );

                $this->$propertyName = $object;
            }
        };
    }
}
