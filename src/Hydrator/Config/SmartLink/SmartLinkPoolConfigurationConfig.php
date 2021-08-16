<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkPoolConfiguration;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\BooleanValue;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class SmartLinkPoolConfigurationConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\SmartLink
 */
class SmartLinkPoolConfigurationConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new SmartLinkPoolConfiguration();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'pool_id' => IntegerValue::set('poolId'),
            'pool_attribute_id' => IntegerValue::set('poolAttributeId'),
            'value' => StringValue::set('value'),
            'is_merge' => BooleanValue::set('isMerge')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'pool_id' => IntegerValue::get('poolId'),
            'pool_attribute_id' => IntegerValue::get('poolAttributeId'),
            'value' => StringValue::get('value'),
            'is_merge' => BooleanValue::get('isMerge')
        ];
    }
}
