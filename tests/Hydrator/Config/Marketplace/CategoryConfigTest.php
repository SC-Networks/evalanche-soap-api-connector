<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Marketplace;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Marketplace\CategoryInterface;

class CategoryConfigTest extends TestCase
{
    /**
     * @var CategoryConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'Id',
        'Text',
    ];

    public function setUp(): void
    {
        $this->subject = new CategoryConfig();
    }

    public function testGetObjectCanReturnInstanceOfProduct()
    {
        $this->assertInstanceOf(
            CategoryInterface::class,
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
