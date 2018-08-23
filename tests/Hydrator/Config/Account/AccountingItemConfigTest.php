<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Account\AccountingItemInterface;

/**
 * Class AccountingItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class AccountingItemConfigTest extends TestCase
{
    /**
     * @var AccountingItemConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'Description',
        'CustomerId',
        'AccountingDate',
        'ChargeCount',
    ];

    public function setUp()
    {
        $this->subject = new AccountingItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            AccountingItemInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            $this->assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            $this->assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
