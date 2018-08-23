<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\SmartLink;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink\SmartLinkConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkInterface;

/**
 * Class SmartLinkConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\SmartLink
 */
class SmartLinkConfigTest extends TestCase
{
    /**
     * @var SmartLinkConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
        'tracking_url',
    ];

    public function setUp()
    {
        $this->subject = new SmartLinkConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            SmartLinkInterface::class,
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
