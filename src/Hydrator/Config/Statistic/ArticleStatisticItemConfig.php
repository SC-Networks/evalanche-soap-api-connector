<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\ArticleStatisticItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class ArticleStatisticItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class ArticleStatisticItemConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ArticleStatisticItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
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
            'name' => Property\TextValue::get('name'),
            'clicks' => Property\IntegerValue::get('clickCount'),
            'unique_clicks' => Property\IntegerValue::get('uniqueClickCount'),
        ];
    }
}