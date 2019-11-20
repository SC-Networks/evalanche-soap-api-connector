<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileGroupScore;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class ProfileGroupScoreConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Profile
 */
class ProfileGroupScoreConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ProfileGroupScore();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'profile_id' => IntegerValue::set('profileId'),
            'group_id' => IntegerValue::set('groupId'),
            'group_name' => StringValue::set('groupName'),
            'activity_score' => IntegerValue::set('activityScore'),
            'profile_score' => IntegerValue::set('profileScore'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'profile_id' => IntegerValue::get('profileId'),
            'group_id' => IntegerValue::get('groupId'),
            'group_name' => StringValue::get('groupName'),
            'activity_score' => IntegerValue::get('activityScore'),
            'profile_score' => IntegerValue::get('profileScore'),
        ];
    }
}
