<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\TargetGroup;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupMemberShip;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class TargetGroupMemberShipConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\TargetGroup
 */
class TargetGroupMemberShipConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new TargetGroupMemberShip();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'profile_id' => Property\IntegerValue::set('profileId'),
            'targetgroup_id' => Property\IntegerValue::set('targetGroupId'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'profile_id' => Property\IntegerValue::get('profileId'),
            'targetgroup_id' => Property\IntegerValue::get('targetGroupId'),
        ];
    }
}