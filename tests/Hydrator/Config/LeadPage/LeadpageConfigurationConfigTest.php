<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\LeadPage;

use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageConfigurationInterface;

class LeadpageConfigurationConfigTest extends \Scn\EvalancheSoapApiConnector\TestCase
{
    private LeadpageConfigurationConfig $subject;

    private array $arrayKeys = [
        'inputfield_0',
        'inputfield_1',
        'inputfield_2',
        'inputfield_3',
        'inputfield_4',
        'inputfield_5',
        'inputfield_6',
        'inputfield_7',
        'inputfield_8',
        'inputfield_9',
        'textarea_0',
        'textarea_1',
        'textarea_2',
        'textarea_3',
        'textarea_4',
        'textarea_5',
        'textarea_6',
        'textarea_7',
        'textarea_8',
        'textarea_9',
        'htmlarea_0',
        'htmlarea_1',
        'htmlarea_2',
        'htmlarea_3',
        'htmlarea_4',
        'htmlarea_5',
        'htmlarea_6',
        'htmlarea_7',
        'htmlarea_8',
        'htmlarea_9',
        'macro_library',
    ];

    public function setUp(): void
    {
        $this->subject = new LeadpageConfigurationConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            LeadpageConfigurationInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
