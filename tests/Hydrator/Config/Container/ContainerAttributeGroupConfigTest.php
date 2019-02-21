<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Container;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Container\ContainerAttributeGroupConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeGroupInterface;

/**
 * Class ContainerAttributeGroupConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeGroupConfigTest extends TestCase
{
    /**
     * @var ContainerAttributeGroupConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
        'sort_order',
    ];

    public function setUp(): void
    {
        $this->subject = new ContainerAttributeGroupConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ContainerAttributeGroupInterface::class,
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
