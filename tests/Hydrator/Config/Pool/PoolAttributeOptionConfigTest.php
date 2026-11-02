<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Pool;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Pool\PoolAttributeOptionInterface;

class PoolAttributeOptionConfigTest extends TestCase
{
    /**
     * @var PoolAttributeConfig
     */
    private PoolAttributeOptionConfig $subject;

    private array $arrayKeys = [
        'id',
        'value',
    ];

    public function setUp(): void
    {
        $this->subject = new PoolAttributeOptionConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            PoolAttributeOptionInterface::class,
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
