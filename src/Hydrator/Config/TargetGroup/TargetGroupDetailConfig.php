<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\TargetGroup;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupDetail;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class TargetGroupDetailConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\TargetGroup
 */
class TargetGroupDetailConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new TargetGroupDetail();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'name' => Property\TextValue::set('name'),
            'profile_count' => Property\IntegerValue::set('profileCount'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'name' => Property\TextValue::get('name'),
            'profile_count' => Property\IntegerValue::get('profileCount'),
        ];
    }
}
