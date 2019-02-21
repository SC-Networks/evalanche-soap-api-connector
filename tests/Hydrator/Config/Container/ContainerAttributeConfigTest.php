<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Container;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Container\ContainerAttributeConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeInterface;

/**
 * Class ContainerAttributeConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeConfigTest extends TestCase
{
    /**
     * @var ContainerAttributeConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'label',
        'type_id',
        'group_id',
        'help_text',
        'input_help_text',
        'mandatory',
        'visible',
        'replacement_variable',
        'allows_options',
    ];

    public function setUp(): void
    {
        $this->subject = new ContainerAttributeConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ContainerAttributeInterface::class,
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
