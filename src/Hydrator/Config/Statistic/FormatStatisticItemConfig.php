<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\FormatStatisticItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'clicks' => Property\IntegerValue::set('clickCount'),
            'unique_clicks' => Property\IntegerValue::set('uniqueClickCount'),
            'clickrate' => Property\FloatValue::set('clickRate'),
            'clickrate_relative' => Property\FloatValue::set('clickRateRelative'),
            'multiple_clickrate' => Property\FloatValue::set('multipleClickRate'),
            'multiple_clickrate_relative' => Property\FloatValue::set('multipleClickRateRelative'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'clicks' => Property\IntegerValue::get('clickCount'),
            'unique_clicks' => Property\IntegerValue::get('uniqueClickCount'),
            'clickrate' => Property\FloatValue::get('clickRate'),
            'clickrate_relative' => Property\FloatValue::get('clickRateRelative'),
            'multiple_clickrate' => Property\FloatValue::get('multipleClickRate'),
            'multiple_clickrate_relative' => Property\FloatValue::get('multipleClickRateRelative'),
        ];
    }
}
