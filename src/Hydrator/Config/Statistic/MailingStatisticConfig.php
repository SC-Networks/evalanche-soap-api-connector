<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\MailingStatistic;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class MailingStatisticConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class MailingStatisticConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MailingStatistic();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'addressees' => Property\IntegerValue::set('addresses'),
            'recipients' => Property\IntegerValue::set('recipients'),
            'duplicates' => Property\IntegerValue::set('duplicateCount'),
            'blacklisted' => Property\IntegerValue::set('blackListedCount'),
            'robinsonlisted' => Property\IntegerValue::set('robinsonListedCount'),
            'hardbounces' => Property\IntegerValue::set('hardBounceCount'),
            'softbounces' => Property\IntegerValue::set('softBounceCount'),
            'unsubscribes' => Property\IntegerValue::set('unSubscribeCount'),
            'impressions' => Property\IntegerValue::set('impressionCount'),
            'unique_impressions' => Property\IntegerValue::set('uniqueImpressionCount'),
            'clicks' => Property\IntegerValue::set('clickCount'),
            'unique_clicks' => Property\IntegerValue::set('uniqueClickCount'),
            'media' => Property\ArrayValue::set('media'),
            'articles' => Property\ArrayValue::set('articles'),
            'links' => Property\ArrayValue::set('links'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'addressees' => Property\IntegerValue::get('addresses'),
            'recipients' => Property\IntegerValue::get('recipients'),
            'duplicates' => Property\IntegerValue::get('duplicateCount'),
            'blacklisted' => Property\IntegerValue::get('blackListedCount'),
            'robinsonlisted' => Property\IntegerValue::get('robinsonListedCount'),
            'hardbounces' => Property\IntegerValue::get('hardBounceCount'),
            'softbounces' => Property\IntegerValue::get('softBounceCount'),
            'unsubscribes' => Property\IntegerValue::get('unSubscribeCount'),
            'impressions' => Property\IntegerValue::get('impressionCount'),
            'unique_impressions' => Property\IntegerValue::get('uniqueImpressionCount'),
            'clicks' => Property\IntegerValue::get('clickCount'),
            'unique_clicks' => Property\IntegerValue::get('uniqueClickCount'),
            'media' => Property\ArrayValue::get('media'),
            'articles' => Property\ArrayValue::get('articles'),
            'links' => Property\ArrayValue::get('links'),
        ];
    }
}
