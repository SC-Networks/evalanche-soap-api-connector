<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingStatusInterface;

/**
 * Class MailingStatusConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingStatusConfigTest extends TestCase
{
    /**
     * @var MailingStatusConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'profile_id',
        'newsletter_id',
        'last_status_change',
        'status',
        'preview_url',
        'profile_data',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingStatusConfig();
    }

    public function testGetObjectCanReturnInstanceOfMailingStatusConfig()
    {
        $this->assertInstanceOf(
            MailingStatusInterface::class,
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
        $this->assertSame([], $this->subject->getExtractorProperties());
    }
}
