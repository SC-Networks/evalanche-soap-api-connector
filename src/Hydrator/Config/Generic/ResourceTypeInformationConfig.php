<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceTypeInformation;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class ResourceTypeInformationConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class ResourceTypeInformationConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ResourceTypeInformation();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'description' => StringValue::set('description')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'description' => StringValue::get('description')
        ];
    }
}
