<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\TargetGroup;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\TargetGroup\TargetGroupDetailConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupDetailInterface;

/**
 * Class TargetGroupDetailConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\TargetGroup
 */
class TargetGroupDetailConfigTest extends TestCase
{
    /**
     * @var TargetGroupDetailConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'name',
        'profile_count',
    ];

    public function setUp()
    {
        $this->subject = new TargetGroupDetailConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            TargetGroupDetailInterface::class,
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
