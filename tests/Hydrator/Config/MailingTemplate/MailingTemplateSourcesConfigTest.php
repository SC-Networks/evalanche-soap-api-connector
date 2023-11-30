<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\MailingTemplate;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplatesSourcesInterface;

class MailingTemplateSourcesConfigTest extends TestCase
{
    /** @var MailingTemplateSourcesConfig|null */
    private $subject;

    private $arrayKeys = [
        'email',
        'text',
        'web',
        'pdf',
        'landingpage',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingTemplateSourcesConfig();
    }

    public function testGetObjectReturnsObject(): void
    {
        self::assertInstanceOf(
            MailingTemplatesSourcesInterface::class,
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
