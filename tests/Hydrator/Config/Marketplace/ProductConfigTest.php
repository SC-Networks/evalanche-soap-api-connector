<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Marketplace;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Marketplace\ProductInterface;

class ProductConfigTest extends TestCase
{
    private ProductConfig $subject;

    private array $arrayKeys = [
        'Id',
        'Title',
        'Text',
        'Price',
    ];

    public function setUp(): void
    {
        $this->subject = new ProductConfig();
    }

    public function testGetObjectCanReturnInstanceOfProduct(): void
    {
        self::assertInstanceOf(
            ProductInterface::class,
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
