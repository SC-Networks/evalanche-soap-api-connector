<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\SmartLink;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkScoringConfigurationInterface;

/**
 * Class SmartLinkScoringConfigurationConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\SmartLink
 */
class SmartLinkScoringConfigurationConfigTest extends TestCase
{
    private SmartLinkScoringConfigurationConfig $subject;

    private array $arrayKeys = [
        'id',
        'name',
        'value',
        'multiple_score_time_threshold',
        'scoring_group_id',
        'type'
    ];

    public function setUp(): void
    {
        $this->subject = new SmartLinkScoringConfigurationConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            SmartLinkScoringConfigurationInterface::class,
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
