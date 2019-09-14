<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapItemInterface;

/**
 * Class HashMapItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic
 */
class HashMapItemConfigTest extends TestCase
{
    /**
     * @var HashMapConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'key',
        'value'
    ];

    public function setUp(): void
    {
        $this->subject = new HashMapItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            HashMapItemInterface::class,
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
