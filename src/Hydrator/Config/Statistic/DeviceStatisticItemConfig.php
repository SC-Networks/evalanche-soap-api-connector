<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\DeviceStatisticItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class DeviceStatisticItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class DeviceStatisticItemConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new DeviceStatisticItem();
    }

    public function getHydratorProperties(): array
    {
        return [
            'description' => StringValue::set('description'),
            'count' => IntegerValue::set('count'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'description' => StringValue::get('description'),
            'count' => IntegerValue::get('count'),
        ];
    }
}
