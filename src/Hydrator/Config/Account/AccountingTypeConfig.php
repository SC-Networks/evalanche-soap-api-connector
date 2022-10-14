<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Account\AccountingType;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\FloatValue;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class AccountingTypeConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class AccountingTypeConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new AccountingType();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'TypeId' => IntegerValue::set('typeId'),
            'Amount' => IntegerValue::set('amount'),
            'Price' => FloatValue::set('price'),
            'Currency' => StringValue::set('currency'),
            'AccountingItems' => Property\ArrayOfObjectValue::set('accountingItems', new AccountingItemConfig())
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'TypeId' => IntegerValue::get('typeId'),
            'Amount' => IntegerValue::get('amount'),
            'Price' => FloatValue::get('price'),
            'Currency' => StringValue::get('currency'),
            'AccountingItems' => Property\ArrayOfObjectValue::get('accountingItems')
        ];
    }
}
