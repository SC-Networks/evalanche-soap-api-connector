<?php

declare(strict_types=1);

namespace Hydrator\Config\MailingTemplate;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\MailingTemplate\MailingTemplateAllowedTemplatesConfig;
use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateAllowedTemplatesInterface;

class MailingTemplateAllowedTemplatesConfigTest extends TestCase
{
    private MailingTemplateAllowedTemplatesConfig $subject;

    private array $arrayKeys = [
        'template_type',
        'template_ids',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingTemplateAllowedTemplatesConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            MailingTemplateAllowedTemplatesInterface::class,
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
