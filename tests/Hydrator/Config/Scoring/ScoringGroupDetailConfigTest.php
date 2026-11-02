<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Scoring;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Scoring\ScoringGroupDetailInterface;

/**
 * Class ScoringGroupDetailConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Scoring
 */
class ScoringGroupDetailConfigTest extends TestCase
{
    private ScoringGroupDetailConfig $subject;

    private array $arrayKeys = [
        'id',
        'name',
        'mandator_id',
    ];

    public function setUp(): void
    {
        $this->subject = new ScoringGroupDetailConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            ScoringGroupDetailInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray(): void
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray(): void
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
