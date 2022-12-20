<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\MailClientStatisticItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class MailClientStatisticItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class MailClientStatisticItemConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MailClientStatisticItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'description' => StringValue::set('description'),
            'count' => IntegerValue::set('count'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'description' => StringValue::get('description'),
            'count' => IntegerValue::get('count'),
        ];
    }
}
