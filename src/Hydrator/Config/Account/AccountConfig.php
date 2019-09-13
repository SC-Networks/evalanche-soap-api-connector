<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Account\Account;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class AccountConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class AccountConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new Account();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'AccountingTypes' => Property\ArrayOfObjectValue::set('accountingTypes', new AccountingTypeConfig()),
            'Discount' => Property\ArrayOfObjectValue::set('discount', new DiscountConfig()),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'AccountingTypes' => Property\ArrayOfObjectValue::get('accountingTypes'),
            'Discount' => Property\ArrayOfObjectValue::get('discount'),
        ];
    }
}
