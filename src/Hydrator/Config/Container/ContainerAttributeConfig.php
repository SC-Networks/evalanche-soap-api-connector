<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Container;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttribute;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\BooleanValue;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class ContainerAttributeConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ContainerAttribute();
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
            'type_id' => IntegerValue::set('typeId'),
            'group_id' => IntegerValue::set('groupId'),
            'help_text' => StringValue::set('helpText'),
            'input_help_text' => StringValue::set('inputHelpText'),
            'mandatory' => BooleanValue::set('mandatory'),
            'visible' => BooleanValue::set('visible'),
            'replacement_variable' => StringValue::set('replacementVariable'),
            'allows_options' => BooleanValue::set('allowOptions'),
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
            'type_id' => IntegerValue::get('typeId'),
            'group_id' => IntegerValue::get('groupId'),
            'help_text' => StringValue::get('helpText'),
            'input_help_text' => StringValue::get('inputHelpText'),
            'mandatory' => BooleanValue::get('mandatory'),
            'visible' => BooleanValue::get('visible'),
            'replacement_variable' => StringValue::get('replacementVariable'),
            'allows_options' => BooleanValue::get('allowOptions'),
        ];
    }
}
