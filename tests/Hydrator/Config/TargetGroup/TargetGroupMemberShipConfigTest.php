<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\TargetGroup;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\TargetGroup\TargetGroupMemberShipConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupMemberShipInterface;

/**
 * Class TargetGroupMemberShipConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\TargetGroup
 */
class TargetGroupMemberShipConfigTest extends TestCase
{
    /**
     * @var TargetGroupMemberShipConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'profile_id',
        'targetgroup_id',
    ];

    public function setUp()
    {
        $this->subject = new TargetGroupMemberShipConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            TargetGroupMemberShipInterface::class,
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
