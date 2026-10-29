<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\BrowserStatisticItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class BrowserStatisticItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class BrowserStatisticItemConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new BrowserStatisticItem();
    }

    public function getHydratorProperties(): array
    {
        return [
            'description' => StringValue::set('description'),
            'version' => StringValue::set('version'),
            'count' => IntegerValue::set('count'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'description' => StringValue::get('description'),
            'version' => StringValue::get('version'),
            'count' => IntegerValue::get('count'),
        ];
    }
}
