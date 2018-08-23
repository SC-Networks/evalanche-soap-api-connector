<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\LinkStatisticItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class LinkStatisticItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class LinkStatisticItemConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new LinkStatisticItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
            'url' => Property\TextValue::set('url'),
            'clicks' => Property\IntegerValue::set('clickCount'),
            'unique_clicks' => Property\IntegerValue::set('unique_clicks')
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
            'url' => Property\TextValue::get('url'),
            'clicks' => Property\IntegerValue::get('clickCount'),
            'unique_clicks' => Property\IntegerValue::get('unique_clicks')
        ];
    }
}