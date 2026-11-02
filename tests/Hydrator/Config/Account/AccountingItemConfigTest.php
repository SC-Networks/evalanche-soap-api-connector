<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Account;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Account\AccountingItemInterface;

/**
 * Class AccountingItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Account
 */
class AccountingItemConfigTest extends TestCase
{
    private AccountingItemConfig $subject;

    private array $arrayKeys = [
        'Description',
        'CustomerId',
        'AccountingDate',
        'ChargeCount',
    ];

    public function setUp(): void
    {
        $this->subject = new AccountingItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            AccountingItemInterface::class,
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
