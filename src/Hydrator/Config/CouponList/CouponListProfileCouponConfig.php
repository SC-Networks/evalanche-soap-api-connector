<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\CouponList;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\CouponList\ProfileCoupon;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

class CouponListProfileCouponConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new ProfileCoupon();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'code' => StringValue::set('code'),
            'profile_id' => IntegerValue::set('profile_id'),
            'creation_date' => IntegerValue::set('creation_date'),
            'valid_to' => IntegerValue::set('valid_to'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'code' => StringValue::get('code'),
            'profile_id' => IntegerValue::get('profileId'),
            'creation_date' => IntegerValue::get('creationDate'),
            'valid_to' => IntegerValue::get('validTo'),
        ];
    }
}
