<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class HashMapItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic
 */
class HashMapItemConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new HashMapItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'key' => Property\TextValue::set('key'),
            'value' => Property\TextValue::set('value'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'key' => Property\TextValue::get('key'),
            'value' => Property\TextValue::get('value'),
        ];
    }
}
