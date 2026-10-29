<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist;

use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackList;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

/**
 * Class BlackListConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist
 */
class BlackListConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new BlackList();
    }

    public function getHydratorProperties(): array
    {
        return [
            'CustomerId' => IntegerValue::set('mandatorId'),
            'Item' => ArrayOfObjectValue::set('items', new BlackListItemConfig()),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'CustomerId' => IntegerValue::get('mandatorId'),
            'Item' => ArrayOfObjectValue::get('items'),
        ];
    }
}
