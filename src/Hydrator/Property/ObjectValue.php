<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\Hydrator\Hydrator;

/**
 * Class ObjectValue
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
class ObjectValue implements PropertyObjectInterface
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
        return function () use ($propertyName): ?object {
            return $this->$propertyName;
        };
    }

    /**
     * @param string $propertyName
     *
     * @param HydratorConfigInterface $hydratorConfig
     * @return \Closure
     */
    public static function set(string $propertyName, HydratorConfigInterface $hydratorConfig = null): \Closure
    {
        return (new static())->createSetter($propertyName, $hydratorConfig);
    }

    /**
     * @param string $propertyName
     *
     * @param HydratorConfigInterface $hydratorConfig
     * @return \Closure
     */
    private function createSetter(string $propertyName, HydratorConfigInterface $hydratorConfig = null): \Closure
    {
        return function ($value) use ($propertyName, $hydratorConfig): void {
            if ($hydratorConfig instanceof HydratorConfigInterface) {
                $hydrator = new Hydrator();

                $object = $hydratorConfig->getObject();

                $hydrator->hydrate(
                    $hydratorConfig,
                    $object,
                    (array)$value
                );

                $this->$propertyName = $object;
            }
        };
    }
}
