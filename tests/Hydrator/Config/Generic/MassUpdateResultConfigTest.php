<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\MassUpdateResultConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\MassUpdateResultInterface;

/**
 * Class MassUpdateResultConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class MassUpdateResultConfigTest extends TestCase
{
    /**
     * @var MassUpdateResultConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'updated',
        'created',
        'ignored',
        'error',
    ];

    public function setUp(): void
    {
        $this->subject = new MassUpdateResultConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            MassUpdateResultInterface::class,
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
