<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\MediaStatisticItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class MediaStatisticItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class MediaStatisticItemConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MediaStatisticItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'clicks' => Property\IntegerValue::set('clickCount'),
            'unique_clicks' => Property\IntegerValue::set('uniqueClickCount'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'clicks' => Property\IntegerValue::get('clickCount'),
            'unique_clicks' => Property\IntegerValue::get('uniqueClickCount'),
        ];
    }
}
