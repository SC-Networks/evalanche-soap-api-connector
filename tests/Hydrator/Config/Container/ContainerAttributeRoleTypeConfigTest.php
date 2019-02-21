<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Container;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Container\ContainerAttributeRoleTypeConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeRoleTypeInterface;

/**
 * Class ContainerAttributeRoleTypeConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeRoleTypeConfigTest extends TestCase
{
    /**
     * @var ContainerAttributeRoleTypeConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
    ];

    public function setUp(): void
    {
        $this->subject = new ContainerAttributeRoleTypeConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ContainerAttributeRoleTypeInterface::class,
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
