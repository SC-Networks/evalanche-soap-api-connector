<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\ServiceStatusConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\ServiceStatusInterface;

/**
 * Class ServiceStatusConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class ServiceStatusConfigTest extends TestCase
{
    /**
     * @var ServiceStatusConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'status',
        'message',
    ];

    public function setUp()
    {
        $this->subject = new ServiceStatusConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ServiceStatusInterface::class,
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
