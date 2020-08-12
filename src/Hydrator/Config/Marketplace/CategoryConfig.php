<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Marketplace;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Marketplace\Category;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

class CategoryConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new Category();
    }

    public function getHydratorProperties(): array
    {
        return [
            'Id' => IntegerValue::set('id'),
            'Text' => StringValue::set('text'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'Id' => IntegerValue::get('id'),
            'Text' => StringValue::get('text'),
        ];
    }
}
