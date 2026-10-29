<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mandator;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Mandator\Mandator;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class MandatorConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mandator
 */
class MandatorConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new Mandator();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'domain' => StringValue::set('domain')
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'name' => StringValue::get('name'),
            'domain' => StringValue::get('domain')
        ];
    }
}
