<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingClick;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'id' => Property\IntegerValue::set('id'),
            'profile_id' => Property\IntegerValue::set('profileId'),
            'timestamp' => Property\IntegerValue::set('timestamp'),
            'link_id' => Property\IntegerValue::set('linkId'),
            'link_type_id' => Property\IntegerValue::set('linkTypeId'),
            'parent_id' => Property\IntegerValue::set('parentId'),
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
            'link_id' => Property\IntegerValue::get('linkId'),
            'link_type_id' => Property\IntegerValue::get('linkTypeId'),
            'parent_id' => Property\IntegerValue::get('parentId'),
        ];
    }
}