<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Pool\PoolAttributeOptionInterface;

class PoolAttributeOptionConfigTest extends TestCase
{
    /**
     * @var PoolAttributeConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'id',
        'value',
    ];

    public function setUp(): void
    {
        $this->subject = new PoolAttributeOptionConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            PoolAttributeOptionInterface::class,
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
