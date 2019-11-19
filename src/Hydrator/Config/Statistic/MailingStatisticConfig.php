<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\MailingStatistic;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

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
            'addressees' => IntegerValue::set('addresses'),
            'recipients' => IntegerValue::set('recipients'),
            'duplicates' => IntegerValue::set('duplicateCount'),
            'blacklisted' => IntegerValue::set('blackListedCount'),
            'robinsonlisted' => IntegerValue::set('robinsonListedCount'),
            'hardbounces' => IntegerValue::set('hardBounceCount'),
            'softbounces' => IntegerValue::set('softBounceCount'),
            'unsubscribes' => IntegerValue::set('unSubscribeCount'),
            'impressions' => IntegerValue::set('impressionCount'),
            'unique_impressions' => IntegerValue::set('uniqueImpressionCount'),
            'clicks' => IntegerValue::set('clickCount'),
            'unique_clicks' => IntegerValue::set('uniqueClickCount'),
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
            'addressees' => IntegerValue::get('addresses'),
            'recipients' => IntegerValue::get('recipients'),
            'duplicates' => IntegerValue::get('duplicateCount'),
            'blacklisted' => IntegerValue::get('blackListedCount'),
            'robinsonlisted' => IntegerValue::get('robinsonListedCount'),
            'hardbounces' => IntegerValue::get('hardBounceCount'),
            'softbounces' => IntegerValue::get('softBounceCount'),
            'unsubscribes' => IntegerValue::get('unSubscribeCount'),
            'impressions' => IntegerValue::get('impressionCount'),
            'unique_impressions' => IntegerValue::get('uniqueImpressionCount'),
            'clicks' => IntegerValue::get('clickCount'),
            'unique_clicks' => IntegerValue::get('uniqueClickCount'),
            'media' => Property\ArrayValue::get('media'),
            'articles' => Property\ArrayValue::get('articles'),
            'links' => Property\ArrayValue::get('links'),
        ];
    }
}
