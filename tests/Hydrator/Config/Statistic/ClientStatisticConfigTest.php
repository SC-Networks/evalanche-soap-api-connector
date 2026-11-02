<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\ClientStatisticInterface;

/**
 * Class ClientStatisticConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class ClientStatisticConfigTest extends TestCase
{
    private ClientStatisticConfig $subject;

    private array $arrayKeys = [
        'mail_clients',
        'browsers',
        'devices',
    ];

    public function setUp(): void
    {
        $this->subject = new ClientStatisticConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            ClientStatisticInterface::class,
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
