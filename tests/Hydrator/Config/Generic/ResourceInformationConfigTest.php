<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\ResourceInformationConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Class ResourceInformationConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class ResourceInformationConfigTest extends TestCase
{
    /**
     * @var ResourceInformationConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'url',
        'type_id',
        'category_id',
        'customer_id',
        'id',
        'name',
    ];

    public function setUp()
    {
        $this->subject = new ResourceInformationConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ResourceInformationInterface::class,
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
