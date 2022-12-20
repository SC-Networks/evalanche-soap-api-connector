<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\HashMapConfig;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileBounceStatus;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

/**
 * Class ProfileBounceStatusConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Profile
 */
class ProfileBounceStatusConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ProfileBounceStatus();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'profile_id' => IntegerValue::set('profileId'),
            'mailing_id' => IntegerValue::set('mailingId'),
            'status' => IntegerValue::set('status'),
            'timestamp' => IntegerValue::set('timestamp'),
            'profile_data' => Property\ObjectValue::set('profileData', new HashMapConfig()),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'profile_id' => IntegerValue::get('profileId'),
            'mailing_id' => IntegerValue::get('mailingId'),
            'status' => IntegerValue::get('status'),
            'timestamp' => IntegerValue::get('timestamp'),
            'profile_data' => Property\ObjectValue::get('profileData'),
        ];
    }
}
