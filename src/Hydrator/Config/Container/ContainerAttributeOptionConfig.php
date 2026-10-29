<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Container;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeOption;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class ContainerAttributeOptionConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeOptionConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new ContainerAttributeOption();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'label' => StringValue::set('label'),
            'order' => StringValue::set('order'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'name' => StringValue::get('name'),
            'label' => StringValue::get('label'),
            'order' => StringValue::get('order'),
        ];
    }
}
