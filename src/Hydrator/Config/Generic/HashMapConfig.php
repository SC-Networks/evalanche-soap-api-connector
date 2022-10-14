<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMap;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class HashMapConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class HashMapConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new HashMap();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'items' => Property\ArrayOfObjectValue::set('items', new HashMapItemConfig()),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'items' => Property\ArrayOfObjectValue::get('items')
        ];
    }
}
