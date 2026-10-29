<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class HashMapItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic
 */
class HashMapItemConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new HashMapItem();
    }

    public function getHydratorProperties(): array
    {
        return [
            'key' => StringValue::set('key'),
            'value' => StringValue::set('value'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'key' => StringValue::get('key'),
            'value' => StringValue::get('value'),
        ];
    }
}
