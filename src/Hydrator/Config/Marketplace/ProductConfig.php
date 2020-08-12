<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Marketplace;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Marketplace\Product;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

class ProductConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new Product();
    }

    public function getHydratorProperties(): array
    {
        return [
            'Id' => StringValue::set('id'),
            'Title' => StringValue::set('title'),
            'Text' => StringValue::set('text'),
            'Price' => IntegerValue::set('price'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'Id' => StringValue::get('id'),
            'Title' => StringValue::get('title'),
            'Text' => StringValue::get('text'),
            'Price' => IntegerValue::get('price'),
        ];
    }
}
