<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingClickConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingClickInterface;

/**
 * Class MailingClickConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingClickConfigTest extends TestCase
{
    /**
     * @var MailingClickConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'profile_id',
        'timestamp',
        'link_id',
        'link_type_id',
        'parent_id',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingClickConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            MailingClickInterface::class,
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
