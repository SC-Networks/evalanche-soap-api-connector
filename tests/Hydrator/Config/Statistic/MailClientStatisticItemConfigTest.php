<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\MailClientStatisticItem;

/**
 * Class MailClientStatisticItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class MailClientStatisticItemConfigTest extends TestCase
{
    private MailClientStatisticItemConfig $subject;

    private array $arrayKeys = [
        'description',
        'count',
    ];

    public function setUp(): void
    {
        $this->subject = new MailClientStatisticItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            MailClientStatisticItem::class,
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
