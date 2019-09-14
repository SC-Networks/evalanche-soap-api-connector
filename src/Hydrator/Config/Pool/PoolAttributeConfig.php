<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Pool\PoolAttribute;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class PoolAttributeConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Pool
 */
class PoolAttributeConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new PoolAttribute();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
            'label' => Property\TextValue::set('label'),
            'has_options' => Property\BooleanValue::set('hasOptions'),
            'can_add_options' => Property\BooleanValue::set('addOptions'),
            'options' => Property\ArrayOfObjectValue::set('options', new PoolAttributeOptionConfig()),
            'type_id' => Property\IntegerValue::set('typeId')
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
            'label' => Property\TextValue::get('label'),
            'has_options' => Property\BooleanValue::get('hasOptions'),
            'can_add_options' => Property\BooleanValue::get('addOptions'),
            'options' => Property\ArrayOfObjectValue::get('options'),
            'type_id' => Property\IntegerValue::get('typeId')
        ];
    }
}
