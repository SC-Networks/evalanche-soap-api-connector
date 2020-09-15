<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\ConfigTestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlot;

class MailingSlotConfigTest extends ConfigTestCase
{
    /** @var MailingSlotConfig|null */
    private $subject;
    
    public function setUp(): void
    {
        $this->subject = new MailingSlotConfig();
    }

    public function testGetObjectReturnsData(): void
    {
        $this->assertInstanceOf(
            MailingSlot::class,
            $this->subject->getObject()
        );
    }

    protected function getArrayKeys(): array
    {
        return [
            'id',
            'name',
            'slot_number',
            'sort_type_id',
            'sort_type_value',
            'items',
        ];
    }

    protected function getSubject()
    {
        return $this->subject;
    }
}
