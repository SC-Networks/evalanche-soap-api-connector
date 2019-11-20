<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingStatus;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class MailingStatusConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingStatusConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MailingStatus();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'profile_id' => IntegerValue::set('profileId'),
            'newsletter_id' => IntegerValue::set('newsletterId'),
            'last_status_change' => IntegerValue::set('last_status_change'),
            'status' => IntegerValue::set('status'),
            'preview_url' => StringValue::set('previewUrl'),
            'profile_data' => Property\ArrayValue::set('profileData'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [

        ];
    }
}
