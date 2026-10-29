<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMap;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class HashMapConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class HashMapConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new HashMap();
    }

    public function getHydratorProperties(): array
    {
        return [
            'items' => ArrayOfObjectValue::set('items', new HashMapItemConfig()),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'items' => ArrayOfObjectValue::get('items')
        ];
    }
}
