<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool;

use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
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
    public function getObject(): StructInterface
    {
        return new PoolAttribute();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'label' => StringValue::set('label'),
            'has_options' => BooleanValue::set('hasOptions'),
            'can_add_options' => BooleanValue::set('addOptions'),
            'options' => ArrayOfObjectValue::set('options', new PoolAttributeOptionConfig()),
            'type_id' => IntegerValue::set('typeId')
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'name' => StringValue::get('name'),
            'label' => StringValue::get('label'),
            'has_options' => BooleanValue::get('hasOptions'),
            'can_add_options' => BooleanValue::get('addOptions'),
            'options' => ArrayOfObjectValue::get('options'),
            'type_id' => IntegerValue::get('typeId')
        ];
    }
}
