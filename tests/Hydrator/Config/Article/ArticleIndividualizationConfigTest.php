<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Article;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleIndividualizationInterface;

class ArticleIndividualizationConfigTest extends TestCase
{
    /**
     * @var ArticleIndividualizationConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
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
