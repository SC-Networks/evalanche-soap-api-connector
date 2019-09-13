<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Account\AccountingType;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'TypeId' => Property\IntegerValue::set('typeId'),
            'Amount' => Property\IntegerValue::set('amount'),
            'Price' => Property\FloatValue::set('price'),
            'Currency' => Property\TextValue::set('currency'),
            'AccountingItems' => Property\ArrayOfObjectValue::set('accountingItems', new AccountingItemConfig())
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'TypeId' => Property\IntegerValue::get('typeId'),
            'Amount' => Property\IntegerValue::get('amount'),
            'Price' => Property\FloatValue::get('price'),
            'Currency' => Property\TextValue::get('currency'),
            'AccountingItems' => Property\ArrayOfObjectValue::get('accountingItems')
        ];
    }
}
