<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Pool;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool\PoolAttributeConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Pool\PoolAttributeInterface;

/**
 * Class PoolAttributeConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Pool
 */
class PoolAttributeConfigTest extends TestCase
{
    /**
     * @var PoolAttributeConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
        'label',
        'has_options',
        'can_add_options',
        'options',
        'type_id',
    ];

    public function setUp()
    {
        $this->subject = new PoolAttributeConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            PoolAttributeInterface::class,
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
