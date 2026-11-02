<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ObjectValue;
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
            'Discount' => ObjectValue::set('discount', new DiscountConfig()),
            'AccountingTypes' => ArrayOfObjectValue::set('accountingTypes', new AccountingTypeConfig()),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'Discount' => ObjectValue::get('discount'),
            'AccountingTypes' => ArrayOfObjectValue::get('accountingTypes'),
        ];
    }
}
