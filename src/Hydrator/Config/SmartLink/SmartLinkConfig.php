<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\IntegerValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\TextValue;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLink;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class SmartLinkConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\SmartLink
 */
class SmartLinkConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new SmartLink();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => TextValue::set('name'),
            'tracking_url' => TextValue::set('trackingUrl')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'name' => TextValue::get('name'),
            'tracking_url' => TextValue::get('trackingUrl')
        ];
    }
}