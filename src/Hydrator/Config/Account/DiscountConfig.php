<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Account\Discount;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'Description' => Property\TextValue::set('description'),
            'Percent' => Property\FloatValue::set('percent'),
            'Price' => Property\FloatValue::set('price'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'Description' => Property\TextValue::get('description'),
            'Percent' => Property\FloatValue::get('percent'),
            'Price' => Property\FloatValue::get('price'),
        ];
    }
}