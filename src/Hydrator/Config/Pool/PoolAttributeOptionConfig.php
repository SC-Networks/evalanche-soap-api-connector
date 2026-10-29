<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Pool\PoolAttributeOption;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class PoolAttributeOptionConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool
 */
class PoolAttributeOptionConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new PoolAttributeOption();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'value' => StringValue::set('value'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'value' => StringValue::get('value'),
        ];
    }
}
