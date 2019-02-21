<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Mandator;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mandator\MandatorConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mandator\MandatorInterface;

/**
 * Class MandatorConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mandator
 */
class MandatorConfigTest extends TestCase
{
    /**
     * @var MandatorConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
        'domain'
    ];

    public function setUp(): void
    {
        $this->subject = new MandatorConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            MandatorInterface::class,
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
