<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Pool\PoolAttribute;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\BooleanValue;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

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
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'label' => StringValue::set('label'),
            'has_options' => BooleanValue::set('hasOptions'),
            'can_add_options' => BooleanValue::set('addOptions'),
            'options' => Property\ArrayOfObjectValue::set('options', new PoolAttributeOptionConfig()),
            'type_id' => IntegerValue::set('typeId')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'name' => StringValue::get('name'),
            'label' => StringValue::get('label'),
            'has_options' => BooleanValue::get('hasOptions'),
            'can_add_options' => BooleanValue::get('addOptions'),
            'options' => Property\ArrayOfObjectValue::get('options'),
            'type_id' => IntegerValue::get('typeId')
        ];
    }
}
