<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackListInterface;

/**
 * Class BlackListConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist
 */
class BlackListConfigTest extends TestCase
{
    private BlackListConfig $subject;

    private array $arrayKeys = [
        'CustomerId',
        'Item',
    ];

    public function setUp(): void
    {
        $this->subject = new BlackListConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            BlackListInterface::class,
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
