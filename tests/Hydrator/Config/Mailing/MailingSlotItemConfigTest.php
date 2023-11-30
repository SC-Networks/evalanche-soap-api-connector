<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\ConfigTestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotItem;

class MailingSlotItemConfigTest extends ConfigTestCase
{
    /** @var MailingSlotItemConfig|null */
    private $subject;
    
    public function setUp(): void
    {
        $this->subject = new MailingSlotItemConfig();
    }

    public function testGetObjectReturnsData(): void
    {
        self::assertInstanceOf(
            MailingSlotItem::class,
            $this->subject->getObject()
        );
    }

    protected function getArrayKeys(): array
    {
        return [
            'article_type_id',
            'email_article_template_id',
            'text_article_template_id',
            'pdf_article_template_id',
            'web_article_template_id',
            'landingpage_article_template_id',
            'email_allowed_article_template_ids',
            'text_allowed_article_template_ids',
            'landingpage_allowed_article_template_ids',
            'web_allowed_article_template_ids',
        ];
    }

    protected function getSubject()
    {
        return $this->subject;
    }
}
