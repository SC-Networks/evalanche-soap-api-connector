<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Container;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeGroupInterface;

/**
 * Class ContainerAttributeGroupConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeGroupConfigTest extends TestCase
{
    private ContainerAttributeGroupConfig $subject;

    private array $arrayKeys = [
        'id',
        'name',
        'sort_order',
    ];

    public function setUp(): void
    {
        $this->subject = new ContainerAttributeGroupConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            ContainerAttributeGroupInterface::class,
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
