<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Account\AccountingItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

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
            'Description' => StringValue::set('description'),
            'CustomerId' => IntegerValue::set('mandatorId'),
            'AccountingDate' => StringValue::set('accountingDate'),
            'ChargeCount' => StringValue::set('chargeCount'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'Description' => StringValue::get('description'),
            'CustomerId' => IntegerValue::get('mandatorId'),
            'AccountingDate' => StringValue::get('accountingDate'),
            'ChargeCount' => IntegerValue::get('chargeCount'),
        ];
    }
}
