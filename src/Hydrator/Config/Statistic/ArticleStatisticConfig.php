<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Property\ObjectValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
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
    public function getObject(): StructInterface
    {
        return new ArticleStatistic();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'reference_id' => IntegerValue::set('referenceId'),
            'name' => StringValue::set('name'),
            'overall' => ObjectValue::set('overall', new FormatStatisticItemConfig()),
            'landingpage' => ObjectValue::set('landingPage', new FormatStatisticItemConfig()),
            'print' => ObjectValue::set('print', new FormatStatisticItemConfig()),
            'voice' => ObjectValue::set('voice', new FormatStatisticItemConfig()),
            'social_sharing' => ObjectValue::set('socialSharing', new FormatStatisticItemConfig()),
            'links' => ArrayOfObjectValue::set('links', new LinkStatisticItemConfig()),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'reference_id' => IntegerValue::get('referenceId'),
            'name' => StringValue::get('name'),
            'overall' => ObjectValue::get('overall'),
            'landingpage' => ObjectValue::get('landingPage'),
            'print' => ObjectValue::get('print'),
            'voice' => ObjectValue::get('voice'),
            'social_sharing' => ObjectValue::get('socialSharing'),
            'links' => ArrayOfObjectValue::get('links'),
        ];
    }
}
