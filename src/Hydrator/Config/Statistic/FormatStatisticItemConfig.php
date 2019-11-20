<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\FormatStatisticItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\FloatValue;
use Scn\HydratorPropertyValues\Property\IntegerValue;

/**
 * Class FormatStatisticItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class FormatStatisticItemConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new FormatStatisticItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'clicks' => IntegerValue::set('clickCount'),
            'unique_clicks' => IntegerValue::set('uniqueClickCount'),
            'clickrate' => FloatValue::set('clickRate'),
            'clickrate_relative' => FloatValue::set('clickRateRelative'),
            'multiple_clickrate' => FloatValue::set('multipleClickRate'),
            'multiple_clickrate_relative' => FloatValue::set('multipleClickRateRelative'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'clicks' => IntegerValue::get('clickCount'),
            'unique_clicks' => IntegerValue::get('uniqueClickCount'),
            'clickrate' => FloatValue::get('clickRate'),
            'clickrate_relative' => FloatValue::get('clickRateRelative'),
            'multiple_clickrate' => FloatValue::get('multipleClickRate'),
            'multiple_clickrate_relative' => FloatValue::get('multipleClickRateRelative'),
        ];
    }
}
