<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\BrowserStatisticItemInterface;

/**
 * Class BrowserStatisticItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class BrowserStatisticItemConfigTest extends TestCase
{
    private BrowserStatisticItemConfig $subject;

    private array $arrayKeys = [
        'description',
        'version',
        'count',
    ];

    public function setUp(): void
    {
        $this->subject = new BrowserStatisticItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            BrowserStatisticItemInterface::class,
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
