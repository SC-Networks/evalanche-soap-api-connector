<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Marketplace;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Marketplace\ProductInterface;

class ProductConfigTest extends TestCase
{
    /**
     * @var ProductConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'Id',
        'Title',
        'Text',
        'Price',
    ];

    public function setUp(): void
    {
        $this->subject = new ProductConfig();
    }

    public function testGetObjectCanReturnInstanceOfProduct()
    {
        self::assertInstanceOf(
            ProductInterface::class,
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
