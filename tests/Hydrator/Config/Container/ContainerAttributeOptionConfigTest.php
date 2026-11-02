<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Container;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeOptionInterface;

/**
 * Class ContainerAttributeOptionConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeOptionConfigTest extends TestCase
{
    private ContainerAttributeOptionConfig $subject;

    private array $arrayKeys = [
        'id',
        'name',
        'label',
        'order',
    ];

    public function setUp(): void
    {
        $this->subject = new ContainerAttributeOptionConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            ContainerAttributeOptionInterface::class,
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
