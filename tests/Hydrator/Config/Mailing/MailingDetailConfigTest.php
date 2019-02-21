<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingDetailConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingDetailInterface;

/**
 * Class MailingDetailConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingDetailConfigTest extends TestCase
{
    /**
     * @var MailingDetailConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'name',
        'customer_id',
        'category_id',
        'type_id',
        'url',
        'send_start_time',
        'send_end_time',
        'timestamp',
        'recipients',
        'sent',
        'preview_url',
        'report_url',
        'admin_url',
        'subject',
        'targetgroup_id',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingDetailConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            MailingDetailInterface::class,
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
