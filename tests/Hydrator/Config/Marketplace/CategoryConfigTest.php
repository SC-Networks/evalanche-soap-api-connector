<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Marketplace;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Marketplace\CategoryInterface;

class CategoryConfigTest extends TestCase
{
    private CategoryConfig $subject;

    private array $arrayKeys = [
        'Id',
        'Text',
    ];

    public function setUp(): void
    {
        $this->subject = new CategoryConfig();
    }

    public function testGetObjectCanReturnInstanceOfProduct(): void
    {
        self::assertInstanceOf(
            CategoryInterface::class,
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
