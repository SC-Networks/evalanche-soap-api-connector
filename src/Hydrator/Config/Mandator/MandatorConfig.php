<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mandator;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Mandator\Mandator;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class MandatorConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mandator
 */
class MandatorConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new Mandator();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
            'domain' => Property\TextValue::set('domain')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'name' => Property\TextValue::get('name'),
            'domain' => Property\TextValue::get('domain')
        ];
    }
}
