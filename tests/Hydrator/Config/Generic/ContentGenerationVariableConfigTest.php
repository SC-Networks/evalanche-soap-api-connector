<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\ContentGenerationVariableInterface;

class ContentGenerationVariableConfigTest extends TestCase
{
    private ContentGenerationVariableConfig $subject;

    private array $arrayKeys = [
        'name',
        'default_value',
        'label',
        'help_text'
    ];

    public function setUp(): void
    {
        $this->subject = new ContentGenerationVariableConfig();
    }

    public function testGetObjectReturnsInstance(): void
    {
        self::assertInstanceOf(
            ContentGenerationVariableInterface::class,
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
