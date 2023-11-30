<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\FormatStatisticItemInterface;

/**
 * Class FormatStatisticItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class FormatStatisticItemConfigTest extends TestCase
{
    /**
     * @var FormatStatisticItemConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'clicks',
        'unique_clicks',
        'clickrate',
        'clickrate_relative',
        'multiple_clickrate',
        'multiple_clickrate_relative',
    ];

    public function setUp(): void
    {
        $this->subject = new FormatStatisticItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            FormatStatisticItemInterface::class,
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
