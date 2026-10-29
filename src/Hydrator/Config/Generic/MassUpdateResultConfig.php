<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Property\ObjectValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\MassUpdateResult;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class MassUpdateResultConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class MassUpdateResultConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new MassUpdateResult();
    }

    public function getHydratorProperties(): array
    {
        return [
            'updated' => ObjectValue::set('updated', new HashMapConfig()),
            'created' => ObjectValue::set('created', new HashMapConfig()),
            'ignored' => ArrayValue::set('ignored'),
            'error' => ArrayValue::set('error'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'updated' => ObjectValue::get('updated'),
            'created' => ObjectValue::get('created'),
            'ignored' => ArrayValue::get('ignored'),
            'error' => ArrayValue::get('error'),
        ];
    }
}
