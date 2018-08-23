<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\JobHandleConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\JobHandleInterface;

/**
 * Class JobHandleConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class JobHandleConfigTest extends TestCase
{
    /**
     * @var JobHandleConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'status',
        'status_description',
        'namespace',
        'method',
        'resource_id',
        'result_chunks',
    ];

    public function setUp()
    {
        $this->subject = new JobHandleConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            JobHandleInterface::class,
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
