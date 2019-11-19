<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingClick;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

/**
 * Class MailingClickConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingClickConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MailingClick();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'profile_id' => IntegerValue::set('profileId'),
            'timestamp' => IntegerValue::set('timestamp'),
            'link_id' => IntegerValue::set('linkId'),
            'link_type_id' => IntegerValue::set('linkTypeId'),
            'parent_id' => IntegerValue::set('parentId'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'profile_id' => IntegerValue::get('profileId'),
            'timestamp' => IntegerValue::get('timestamp'),
            'link_id' => IntegerValue::get('linkId'),
            'link_type_id' => IntegerValue::get('linkTypeId'),
            'parent_id' => IntegerValue::get('parentId'),
        ];
    }
}
