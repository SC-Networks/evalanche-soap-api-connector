<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingStatus;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'profile_id' => Property\IntegerValue::set('profileId'),
            'newsletter_id' => Property\IntegerValue::set('newsletterId'),
            'last_status_change' => Property\IntegerValue::set('last_status_change'),
            'status' => Property\IntegerValue::set('status'),
            'preview_url' => Property\TextValue::set('previewUrl'),
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
