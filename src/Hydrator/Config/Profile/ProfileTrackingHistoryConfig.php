<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileTrackingHistory;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

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
            'id' => IntegerValue::set('id'),
            'resource_id' => IntegerValue::set('resourceId'),
            'resource_name' => StringValue::set('resourceName'),
            'resource_type_id' => IntegerValue::set('resourceTypeId'),
            'sub_resource_id' => IntegerValue::set('subResourceId'),
            'sub_resource_name' => StringValue::set('subResourceName'),
            'sub_resource_type_id' => IntegerValue::set('subResourceTypeId'),
            'sub_url' => StringValue::set('subUrl'),
            'profile_id' => IntegerValue::set('profileId'),
            'type' => IntegerValue::set('type'),
            'timestamp' => IntegerValue::set('timestamp'),
            'referrer_domain' => StringValue::set('referrerDomain'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'resource_id' => IntegerValue::get('resourceId'),
            'resource_name' => StringValue::get('resourceName'),
            'resource_type_id' => IntegerValue::get('resourceTypeId'),
            'sub_resource_id' => IntegerValue::get('subResourceId'),
            'sub_resource_name' => StringValue::get('subResourceName'),
            'sub_resource_type_id' => IntegerValue::get('subResourceTypeId'),
            'sub_url' => StringValue::get('subUrl'),
            'profile_id' => IntegerValue::get('profileId'),
            'type' => IntegerValue::get('type'),
            'timestamp' => IntegerValue::get('timestamp'),
            'referrer_domain' => StringValue::get('referrerDomain'),
        ];
    }
}
