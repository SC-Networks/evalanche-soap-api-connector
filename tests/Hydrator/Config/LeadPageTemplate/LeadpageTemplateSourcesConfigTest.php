<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\LeadPageTemplate;

use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\TemplatesSourcesInterface;

class LeadpageTemplateSourcesConfigTest extends \Scn\EvalancheSoapApiConnector\TestCase
{
    /** @var LeadpageTemplateSourcesConfig|null */
    private $subject;

    private $arrayKeys = [
        'web',
        'landingpage',
    ];

    public function setUp(): void
    {
        $this->subject = new LeadpageTemplateSourcesConfig();
    }

    public function testGetObjectReturnsObject(): void
    {
        self::assertInstanceOf(
            TemplatesSourcesInterface::class,
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
