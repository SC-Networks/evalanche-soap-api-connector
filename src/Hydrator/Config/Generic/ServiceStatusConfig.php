<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Generic\ServiceStatus;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'status' => Property\TextValue::set('status'),
            'message' => Property\TextValue::set('message')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'status' => Property\TextValue::get('status'),
            'message' => Property\TextValue::get('message')
        ];
    }
}
