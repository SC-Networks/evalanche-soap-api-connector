<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\Hydrator\Hydrator;

/**
 * Class ArrayOfObjectValue
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
class ArrayOfObjectValue implements PropertyObjectInterface
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
        return function () use ($propertyName): ?array {
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
            $items = [];

            if (isset($value->item)) {
                if (!is_array($value->item)) {
                    $items = [$value->item];
                } else {
                    $items = $value->item;
                }
            } elseif (is_array($value)) {
                $items = $value;
            }

            if ($hydratorConfig instanceof HydratorConfigInterface) {
                $hydrator = new Hydrator();

                foreach ($items as $key => $item) {
                    $object = $hydratorConfig->getObject();

                    $hydrator->hydrate(
                        $hydratorConfig,
                        $object,
                        (array)$item
                    );

                    $items[$key] = $object;
                }
            }

            $this->$propertyName = (array)$items;
        };
    }
}