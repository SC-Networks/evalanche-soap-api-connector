<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkScoringConfiguration;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class SmartLinkScoringConfigurationConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\SmartLink
 */
class SmartLinkScoringConfigurationConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new SmartLinkScoringConfiguration();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'value' => IntegerValue::set('value'),
            'multiple_score_time_threshold' => IntegerValue::set('multipleScoreTimeThreshold'),
            'scoring_group_id' => IntegerValue::set('scoringGroupId'),
            'type' => IntegerValue::set('type')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'name' => StringValue::get('name'),
            'value' => IntegerValue::get('value'),
            'multiple_score_time_threshold' => IntegerValue::get('multipleScoreTimeThreshold'),
            'scoring_group_id' => IntegerValue::get('scoringGroupId'),
            'type' => IntegerValue::get('type')
        ];
    }
}
