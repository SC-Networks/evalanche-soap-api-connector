<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Container;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Container\ContainerAttributeOptionConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeOptionInterface;

/**
 * Class ContainerAttributeOptionConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeOptionConfigTest extends TestCase
{
    /**
     * @var ContainerAttributeOptionConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
        'label',
        'order',
    ];

    public function setUp()
    {
        $this->subject = new ContainerAttributeOptionConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ContainerAttributeOptionInterface::class,
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
