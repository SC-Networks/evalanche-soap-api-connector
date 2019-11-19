<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ServiceStatus;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class ServiceStatusConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class ServiceStatusConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ServiceStatus();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'status' => StringValue::set('status'),
            'message' => StringValue::set('message')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'status' => StringValue::get('status'),
            'message' => StringValue::get('message')
        ];
    }
}
