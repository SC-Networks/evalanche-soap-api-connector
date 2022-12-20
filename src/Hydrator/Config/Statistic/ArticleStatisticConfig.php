<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\ArticleStatistic;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class ArticleStatisticConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class ArticleStatisticConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ArticleStatistic();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'reference_id' => IntegerValue::set('referenceId'),
            'name' => StringValue::set('name'),
            'overall' => Property\ObjectValue::set('overall', new FormatStatisticItemConfig()),
            'landingpage' => Property\ObjectValue::set('landingPage', new FormatStatisticItemConfig()),
            'print' => Property\ObjectValue::set('print', new FormatStatisticItemConfig()),
            'voice' => Property\ObjectValue::set('voice', new FormatStatisticItemConfig()),
            'social_sharing' => Property\ObjectValue::set('socialSharing', new FormatStatisticItemConfig()),
            'links' => Property\ArrayOfObjectValue::set('links', new LinkStatisticItemConfig()),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'reference_id' => IntegerValue::get('referenceId'),
            'name' => StringValue::get('name'),
            'overall' => Property\ObjectValue::get('overall'),
            'landingpage' => Property\ObjectValue::get('landingPage'),
            'print' => Property\ObjectValue::get('print'),
            'voice' => Property\ObjectValue::get('voice'),
            'social_sharing' => Property\ObjectValue::get('socialSharing'),
            'links' => Property\ArrayOfObjectValue::get('links'),
        ];
    }
}
