<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\ArticleStatisticItemConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\ArticleStatisticItemInterface;

/**
 * Class ArticleStatisticItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class ArticleStatisticItemConfigTest extends TestCase
{
    /**
     * @var ArticleStatisticItemConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
        'clicks',
        'unique_clicks',
    ];

    public function setUp()
    {
        $this->subject = new ArticleStatisticItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            ArticleStatisticItemInterface::class,
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
