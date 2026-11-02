<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSubjectInterface;

/**
 * Class MailingSubjectConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingSubjectConfigTest extends TestCase
{
    private MailingSubjectConfig $subject;

    private array $arrayKeys = [
        'targetgroup_id',
        'subjectline',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingSubjectConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            MailingSubjectInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray(): void
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray(): void
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
