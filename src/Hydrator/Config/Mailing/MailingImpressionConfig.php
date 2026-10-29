<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingImpression;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

/**
 * Class MailingImpressionConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingImpressionConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new MailingImpression();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'profile_id' => IntegerValue::set('profileId'),
            'timestamp' => IntegerValue::set('timestamp'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'profile_id' => IntegerValue::get('profileId'),
            'timestamp' => IntegerValue::get('timestamp'),
        ];
    }
}
