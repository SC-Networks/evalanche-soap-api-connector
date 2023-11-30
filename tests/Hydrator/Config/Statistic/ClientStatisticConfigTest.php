<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\ClientStatisticInterface;

/**
 * Class ClientStatisticConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class ClientStatisticConfigTest extends TestCase
{
    /**
     * @var ClientStatisticConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'mail_clients',
        'browsers',
        'devices',
    ];

    public function setUp(): void
    {
        $this->subject = new ClientStatisticConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            ClientStatisticInterface::class,
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
