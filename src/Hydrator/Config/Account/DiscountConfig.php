<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Account\Discount;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\FloatValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class DiscountConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class DiscountConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new Discount();
    }

    public function getHydratorProperties(): array
    {
        return [
            'Description' => StringValue::set('description'),
            'Percent' => FloatValue::set('percent'),
            'Price' => FloatValue::set('price'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'Description' => StringValue::get('description'),
            'Percent' => FloatValue::get('percent'),
            'Price' => FloatValue::get('price'),
        ];
    }
}
