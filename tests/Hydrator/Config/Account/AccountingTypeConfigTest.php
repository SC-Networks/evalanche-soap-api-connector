<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Account\AccountingTypeInterface;

/**
 * Class AccountingTypeConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class AccountingTypeConfigTest extends TestCase
{
    private AccountingTypeConfig $subject;

    private array $arrayKeys = [
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

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            AccountingTypeInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray(): void
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray(): void
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
