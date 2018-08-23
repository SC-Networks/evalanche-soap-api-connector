<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileGroupScore;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'profile_id' => Property\IntegerValue::set('profileId'),
            'group_id' => Property\IntegerValue::set('groupId'),
            'group_name' => Property\TextValue::set('groupName'),
            'activity_score' => Property\IntegerValue::set('activityScore'),
            'profile_score' => Property\IntegerValue::set('profileScore'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'profile_id' => Property\IntegerValue::get('profileId'),
            'group_id' => Property\IntegerValue::get('groupId'),
            'group_name' => Property\TextValue::get('groupName'),
            'activity_score' => Property\IntegerValue::get('activityScore'),
            'profile_score' => Property\IntegerValue::get('profileScore'),
        ];
    }
}