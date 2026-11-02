<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingClickInterface;

/**
 * Class MailingClickConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingClickConfigTest extends TestCase
{
    private MailingClickConfig $subject;

    private array $arrayKeys = [
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

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            MailingClickInterface::class,
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
