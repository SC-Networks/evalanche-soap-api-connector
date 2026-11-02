<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Container;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerDetailInterface;

/**
 * Class ContainerDetailConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerDetailConfigTest extends TestCase
{
    private ContainerDetailConfig $subject;

    private array $arrayKeys = [
        'id',
        'name',
        'url',
        'type_id',
        'category_id',
        'customer_id',
        'container_type_id',
    ];

    public function setUp(): void
    {
        $this->subject = new ContainerDetailConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            ContainerDetailInterface::class,
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
