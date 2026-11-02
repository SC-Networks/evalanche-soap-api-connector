<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\ArticleStatisticInterface;

/**
 * Class ArticleStatisticConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class ArticleStatisticConfigTest extends TestCase
{
    private ArticleStatisticConfig $subject;

    private array $arrayKeys = [
        'id',
        'reference_id',
        'name',
        'overall',
        'landingpage',
        'print',
        'voice',
        'social_sharing',
        'links',
    ];

    public function setUp(): void
    {
        $this->subject = new ArticleStatisticConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            ArticleStatisticInterface::class,
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
