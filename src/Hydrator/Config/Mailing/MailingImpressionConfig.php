<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingImpression;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class MailingImpressionConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingImpressionConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MailingImpression();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'profile_id' => Property\IntegerValue::set('profileId'),
            'timestamp' => Property\IntegerValue::set('timestamp'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'profile_id' => Property\IntegerValue::get('profileId'),
            'timestamp' => Property\IntegerValue::get('timestamp'),
        ];
    }
}