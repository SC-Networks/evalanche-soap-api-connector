<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\ConfigTestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotConfiguration;

class MailingSlotConfigurationConfigTest extends ConfigTestCase
{
    /** @var MailingSlotConfigurationConfig|null */
    private $subject;

    public function setUp(): void
    {
        $this->subject = new MailingSlotConfigurationConfig();
    }

    public function testGetObjectReturnsData(): void
    {
        self::assertInstanceOf(
            MailingSlotConfiguration::class,
            $this->subject->getObject()
        );
    }

    protected function getArrayKeys(): array
    {
        return [
            'items'
        ];
    }

    protected function getSubject(): MailingSlotConfigurationConfig
    {
        return $this->subject;
    }
}
