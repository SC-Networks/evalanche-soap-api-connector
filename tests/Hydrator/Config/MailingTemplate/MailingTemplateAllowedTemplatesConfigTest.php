<?php

declare(strict_types=1);

namespace Hydrator\Config\MailingTemplate;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\MailingTemplate\MailingTemplateAllowedTemplatesConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateAllowedTemplatesInterface;

class MailingTemplateAllowedTemplatesConfigTest extends TestCase
{
    /**
     * @var MailingTemplateAllowedTemplatesConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'template_type',
        'template_ids',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingTemplateAllowedTemplatesConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        $this->assertInstanceOf(
            MailingTemplateAllowedTemplatesInterface::class,
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
