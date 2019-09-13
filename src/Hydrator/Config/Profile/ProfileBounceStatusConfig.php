<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileBounceStatus;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'profile_id' => Property\IntegerValue::set('profileId'),
            'mailing_id' => Property\IntegerValue::set('mailingId'),
            'status' => Property\IntegerValue::set('status'),
            'timestamp' => Property\IntegerValue::set('timestamp'),
            'profile_data' => Property\ArrayValue::set('profileData'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'profile_id' => Property\IntegerValue::get('profileId'),
            'mailing_id' => Property\IntegerValue::get('mailingId'),
            'status' => Property\IntegerValue::get('status'),
            'timestamp' => Property\IntegerValue::get('timestamp'),
            'profile_data' => Property\ArrayValue::get('profileData'),
        ];
    }
}
