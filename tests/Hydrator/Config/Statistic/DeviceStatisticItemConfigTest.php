<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\DeviceStatisticItemConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\DeviceStatisticItemInterface;

/**
 * Class DeviceStatisticItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class DeviceStatisticItemConfigTest extends TestCase
{
    /**
     * @var DeviceStatisticItemConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'description',
        'count',
    ];

    public function setUp(): void
    {
        $this->subject = new DeviceStatisticItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            DeviceStatisticItemInterface::class,
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
