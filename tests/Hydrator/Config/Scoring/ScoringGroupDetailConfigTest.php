<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Scoring;

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

    public function setUp(): void
    {
        $this->subject = new ScoringGroupDetailConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            ScoringGroupDetailInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
