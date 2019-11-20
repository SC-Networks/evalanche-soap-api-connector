<?php

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

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new Discount();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'Description' => StringValue::set('description'),
            'Percent' => FloatValue::set('percent'),
            'Price' => FloatValue::set('price'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'Description' => StringValue::get('description'),
            'Percent' => FloatValue::get('percent'),
            'Price' => FloatValue::get('price'),
        ];
    }
}
