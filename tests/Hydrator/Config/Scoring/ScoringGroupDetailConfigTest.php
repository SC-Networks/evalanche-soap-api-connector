<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Scoring;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Scoring\ScoringGroupDetailConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Scoring\ScoringGroupDetailInterface;

/**
 * Class ScoringGroupDetailConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Scoring
 */
class ScoringGroupDetailConfigTest extends TestCase
{
    /**
     * @var ScoringGroupDetailConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
        'mandator_id',
    ];

    public function setUp()
    {
        $this->subject = new ScoringGroupDetailConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ScoringGroupDetailInterface::class,
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
