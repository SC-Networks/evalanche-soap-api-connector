<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Article;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleIndividualizationItemInterface;

class ArticleIndividualizationItemConfigTest extends TestCase
{
    /**
     * @var ArticleIndividualizationItemConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'targetgroup_id',
        'article_id',
    ];

    public function setUp(): void
    {
        $this->subject = new ArticleIndividualizationItemConfig();
    }

    public function testGetObjectReturnsInstance(): void
    {
        $this->assertInstanceOf(
            ArticleIndividualizationItemInterface::class,
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
