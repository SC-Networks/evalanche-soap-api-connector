<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Account\AccountingTypeInterface;

/**
 * Class AccountingTypeConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class AccountingTypeConfigTest extends TestCase
{
    /**
     * @var AccountingTypeConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'TypeId',
        'Amount',
        'Price',
        'Currency',
        'AccountingItems'
    ];

    public function setUp(): void
    {
        $this->subject = new AccountingTypeConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            AccountingTypeInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
