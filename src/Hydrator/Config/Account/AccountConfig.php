<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Account\Account;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class AccountConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class AccountConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new Account();
    }

    public function getHydratorProperties(): array
    {
        return [
            'AccountingTypes' => ArrayOfObjectValue::set('accountingTypes', new AccountingTypeConfig()),
            'Discount' => ArrayOfObjectValue::set('discount', new DiscountConfig()),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'AccountingTypes' => ArrayOfObjectValue::get('accountingTypes'),
            'Discount' => ArrayOfObjectValue::get('discount'),
        ];
    }
}
