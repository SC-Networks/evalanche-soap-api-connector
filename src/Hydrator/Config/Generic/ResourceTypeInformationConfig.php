<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceTypeInformation;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'id' => Property\IntegerValue::set('id'),
            'description' => Property\TextValue::set('description')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'description' => Property\TextValue::get('description')
        ];
    }
}