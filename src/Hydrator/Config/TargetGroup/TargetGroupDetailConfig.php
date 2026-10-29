<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\TargetGroup;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupDetail;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class TargetGroupDetailConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\TargetGroup
 */
class TargetGroupDetailConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new TargetGroupDetail();
    }

    public function getHydratorProperties(): array
    {
        return [
            'name' => StringValue::set('name'),
            'profile_count' => IntegerValue::set('profileCount'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'name' => StringValue::get('name'),
            'profile_count' => IntegerValue::get('profileCount'),
        ];
    }
}
