<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\LinkStatisticItemConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\LinkStatisticItem;

/**
 * Class LinkStatisticItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class LinkStatisticItemConfigTest extends TestCase
{
    /**
     * @var LinkStatisticItemConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
        'url',
        'clicks',
        'unique_clicks',
    ];

    public function setUp()
    {
        $this->subject = new LinkStatisticItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            LinkStatisticItem::class,
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
