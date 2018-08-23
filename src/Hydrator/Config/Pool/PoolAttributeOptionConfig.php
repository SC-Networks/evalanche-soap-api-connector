<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Pool\PoolAttributeOption;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class PoolAttributeOptionConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool
 */
class PoolAttributeOptionConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new PoolAttributeOption();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'value' => Property\TextValue::set('value'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'value' => Property\TextValue::get('value'),
        ];
    }
}