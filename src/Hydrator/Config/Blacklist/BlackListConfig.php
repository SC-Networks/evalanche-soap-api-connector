<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackList;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class BlackListConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist
 */
class BlackListConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new BlackList();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'CustomerId' => Property\IntegerValue::set('mandatorId'),
            'Item' => Property\ArrayOfObjectValue::set('items', new BlackListItemConfig()),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'CustomerId' => Property\IntegerValue::get('mandatorId'),
            'Item' => Property\ArrayOfObjectValue::get('items'),
        ];
    }
}
