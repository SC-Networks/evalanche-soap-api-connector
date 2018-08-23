<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Container;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeRoleType;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class ContainerAttributeRoleTypeConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeRoleTypeConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ContainerAttributeRoleType();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
        ];
    }
}