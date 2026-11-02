<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Article;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleIndividualizationInterface;

class ArticleIndividualizationConfigTest extends TestCase
{
    private ArticleIndividualizationConfig $subject;

    private array $arrayKeys = [
        'has_fallback',
        'individualization_items',
    ];

    public function setUp(): void
    {
        $this->subject = new ArticleIndividualizationConfig();
    }

    public function testGetObjectReturnsInstance(): void
    {
        self::assertInstanceOf(
            ArticleIndividualizationInterface::class,
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
