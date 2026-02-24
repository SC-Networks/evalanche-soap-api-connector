<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ContentGenerationVariable;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class ContentGenerationVariableConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ContentGenerationVariable();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'name' => StringValue::set('name'),
            'default_value' => StringValue::set('default_value'),
            'label' => StringValue::set('label'),
            'help_text' => StringValue::set('help_text'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'name' => StringValue::get('name'),
            'default_value' => StringValue::get('default_value'),
            'label' => StringValue::get('label'),
            'help_text' => StringValue::get('help_text'),
        ];
    }
}
