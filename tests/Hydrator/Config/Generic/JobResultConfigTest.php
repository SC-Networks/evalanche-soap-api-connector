<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic\JobResultConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\JobResultInterface;

/**
 * Class JobResultConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class JobResultConfigTest extends TestCase
{
    /**
     * @var JobResultConfig
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
        'result',
        'chunks_left',
        'result_size',
    ];

    public function setUp(): void
    {
        $this->subject = new JobResultConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            JobResultInterface::class,
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
