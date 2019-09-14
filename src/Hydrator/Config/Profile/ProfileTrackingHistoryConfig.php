<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileTrackingHistory;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class ProfileTrackingHistoryConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Profile
 */
class ProfileTrackingHistoryConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ProfileTrackingHistory();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'resource_id' => Property\IntegerValue::set('resourceId'),
            'resource_name' => Property\TextValue::set('resourceName'),
            'resource_type_id' => Property\IntegerValue::set('resourceTypeId'),
            'sub_resource_id' => Property\IntegerValue::set('subResourceId'),
            'sub_resource_name' => Property\TextValue::set('subResourceName'),
            'sub_resource_type_id' => Property\IntegerValue::set('subResourceTypeId'),
            'sub_url' => Property\TextValue::set('subUrl'),
            'profile_id' => Property\IntegerValue::set('profileId'),
            'type' => Property\IntegerValue::set('type'),
            'timestamp' => Property\IntegerValue::set('timestamp'),
            'referrer_domain' => Property\TextValue::set('referrerDomain'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'resource_id' => Property\IntegerValue::get('resourceId'),
            'resource_name' => Property\TextValue::get('resourceName'),
            'resource_type_id' => Property\IntegerValue::get('resourceTypeId'),
            'sub_resource_id' => Property\IntegerValue::get('subResourceId'),
            'sub_resource_name' => Property\TextValue::get('subResourceName'),
            'sub_resource_type_id' => Property\IntegerValue::get('subResourceTypeId'),
            'sub_url' => Property\TextValue::get('subUrl'),
            'profile_id' => Property\IntegerValue::get('profileId'),
            'type' => Property\IntegerValue::get('type'),
            'timestamp' => Property\IntegerValue::get('timestamp'),
            'referrer_domain' => Property\TextValue::get('referrerDomain'),
        ];
    }
}
