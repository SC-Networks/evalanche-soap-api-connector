<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Account\AccountInterface;

/**
 * Class AccountConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class AccountConfigTest extends TestCase
{
    /**
     * @var AccountConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'AccountingTypes',
        'Discount',
    ];

    public function setUp()
    {
        $this->subject = new AccountConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            AccountInterface::class,
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