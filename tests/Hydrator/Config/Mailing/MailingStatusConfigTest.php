<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingStatusInterface;

/**
 * Class MailingStatusConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingStatusConfigTest extends TestCase
{
    private MailingStatusConfig $subject;

    private array $arrayKeys = [
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

    public function testGetObjectCanReturnInstanceOfMailingStatusConfig(): void
    {
        self::assertInstanceOf(
            MailingStatusInterface::class,
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
        self::assertSame([], $this->subject->getExtractorProperties());
    }
}
