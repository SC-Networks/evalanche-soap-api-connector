<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayValue;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkConfiguration;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\BooleanValue;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class SmartLinkConfigurationConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\SmartLink
 */
class SmartLinkConfigurationConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new SmartLinkConfiguration();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'target_url' => StringValue::set('targetUrl'),
            'individual_scoring_config' => BooleanValue::set('individualScoringConfig'),
            'restriction_targetgroup_id' => IntegerValue::set('restrictionTargetGroupId'),
            'restriction_useragents' => ArrayValue::set('restrictionUserAgents'),
            'milestone_id' => IntegerValue::set('milestoneId'),
            'activate_redirect' => BooleanValue::set('activateRedirect'),
            'activate_profile_update' => BooleanValue::set('activateProfileUpdate'),
            'activate_tracking' => BooleanValue::set('activateTracking'),
            'scoring_configs' => ArrayOfObjectValue::set('scoringConfigs', new SmartLinkScoringConfigurationConfig()),
            'pool_attributes' => ArrayOfObjectValue::set('poolAttributes', new SmartLinkPoolConfigurationConfig())
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'target_url' => StringValue::get('targetUrl'),
            'individual_scoring_config' => BooleanValue::get('individualScoringConfig'),
            'restriction_targetgroup_id' => IntegerValue::get('restrictionTargetGroupId'),
            'restriction_useragents' => ArrayValue::get('restrictionUserAgents'),
            'milestone_id' => IntegerValue::get('milestoneId'),
            'activate_redirect' => BooleanValue::get('activateRedirect'),
            'activate_profile_update' => BooleanValue::get('activateProfileUpdate'),
            'activate_tracking' => BooleanValue::get('activateTracking'),
            'scoring_configs' => ArrayOfObjectValue::get('scoringConfigs'),
            'pool_attributes' => ArrayOfObjectValue::get('poolAttributes')
        ];
    }
}
