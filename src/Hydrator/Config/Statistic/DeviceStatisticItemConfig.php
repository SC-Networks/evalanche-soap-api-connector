<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\DeviceStatisticItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class DeviceStatisticItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class DeviceStatisticItemConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new DeviceStatisticItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'description' => Property\TextValue::set('description'),
            'count' => Property\IntegerValue::set('count'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'description' => Property\TextValue::get('description'),
            'count' => Property\IntegerValue::get('count'),
        ];
    }
}
