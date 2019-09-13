<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Container;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttribute;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
            'label' => Property\TextValue::set('label'),
            'type_id' => Property\IntegerValue::set('typeId'),
            'group_id' => Property\IntegerValue::set('groupId'),
            'help_text' => Property\TextValue::set('helpText'),
            'input_help_text' => Property\TextValue::set('inputHelpText'),
            'mandatory' => Property\BooleanValue::set('mandatory'),
            'visible' => Property\BooleanValue::set('visible'),
            'replacement_variable' => Property\TextValue::set('replacementVariable'),
            'allows_options' => Property\BooleanValue::set('allowOptions'),
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
            'type_id' => Property\IntegerValue::get('typeId'),
            'group_id' => Property\IntegerValue::get('groupId'),
            'help_text' => Property\TextValue::get('helpText'),
            'input_help_text' => Property\TextValue::get('inputHelpText'),
            'mandatory' => Property\BooleanValue::get('mandatory'),
            'visible' => Property\BooleanValue::get('visible'),
            'replacement_variable' => Property\TextValue::get('replacementVariable'),
            'allows_options' => Property\BooleanValue::get('allowOptions'),
        ];
    }
}
