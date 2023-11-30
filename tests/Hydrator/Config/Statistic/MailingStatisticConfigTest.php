<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\MailingStatisticInterface;

/**
 * Class MailingStatisticConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class MailingStatisticConfigTest extends TestCase
{
    /**
     * @var MailingStatisticConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'addressees',
        'recipients',
        'duplicates',
        'blacklisted',
        'robinsonlisted',
        'hardbounces',
        'softbounces',
        'unsubscribes',
        'impressions',
        'unique_impressions',
        'clicks',
        'unique_clicks',
        'media',
        'articles',
        'links',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingStatisticConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            MailingStatisticInterface::class,
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
