<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingSubjectConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSubjectInterface;

/**
 * Class MailingSubjectConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingSubjectConfigTest extends TestCase
{
    /**
     * @var MailingSubjectConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'targetgroup_id',
        'subjectline',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingSubjectConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            MailingSubjectInterface::class,
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
