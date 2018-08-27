<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Generic\MassUpdateResult;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class MassUpdateResultConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class MassUpdateResultConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MassUpdateResult();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'updated' => Property\ObjectValue::set('updated', new HashMapConfig()),
            'created' => Property\ObjectValue::set('created', new HashMapConfig()),
            'ignored' => Property\ArrayValue::set('ignored'),
            'error' => Property\ArrayValue::set('error'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'updated' => Property\ObjectValue::get('updated'),
            'created' => Property\ObjectValue::get('created'),
            'ignored' => Property\ArrayValue::get('ignored'),
            'error' => Property\ArrayValue::get('error'),
        ];
    }
}