<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Container;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeGroup;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class ContainerAttributeGroupConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeGroupConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ContainerAttributeGroup();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
            'sort_order' => Property\TextValue::set('sortOrder'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'name' => Property\TextValue::get('name'),
            'sort_order' => Property\TextValue::get('sortOrder'),
        ];
    }
}