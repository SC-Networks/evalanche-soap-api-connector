<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\BrowserStatisticItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class BrowserStatisticItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class BrowserStatisticItemConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new BrowserStatisticItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'description' => Property\TextValue::set('description'),
            'version' => Property\TextValue::set('version'),
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
            'version' => Property\TextValue::get('version'),
            'count' => Property\IntegerValue::get('count'),
        ];
    }
}
