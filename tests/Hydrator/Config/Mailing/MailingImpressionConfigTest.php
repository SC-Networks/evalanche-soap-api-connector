<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingImpressionConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingImpressionInterface;

/**
 * Class MailingImpressionConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingImpressionConfigTest extends TestCase
{
    /**
     * @var MailingImpressionConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'profile_id',
        'timestamp',
    ];

    public function setUp()
    {
        $this->subject = new MailingImpressionConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            MailingImpressionInterface::class,
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
