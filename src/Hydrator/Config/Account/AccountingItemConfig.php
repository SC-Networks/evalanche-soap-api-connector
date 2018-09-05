<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Account\AccountingItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class AccountingItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class AccountingItemConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new AccountingItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'Description' => Property\TextValue::set('description'),
            'CustomerId' => Property\IntegerValue::set('mandatorId'),
            'AccountingDate' => Property\TextValue::set('accountingDate'),
            'ChargeCount' => Property\IntegerValue::set('chargeCount'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'Description' => Property\TextValue::get('description'),
            'CustomerId' => Property\IntegerValue::get('mandatorId'),
            'AccountingDate' => Property\TextValue::get('accountingDate'),
            'ChargeCount' => Property\IntegerValue::get('chargeCount'),
        ];
    }
}