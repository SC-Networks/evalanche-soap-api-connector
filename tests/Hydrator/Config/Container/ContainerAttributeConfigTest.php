<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Container;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeInterface;

/**
 * Class ContainerAttributeConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerAttributeConfigTest extends TestCase
{
    private ContainerAttributeConfig $subject;

    private array $arrayKeys = [
        'id',
        'label',
        'type_id',
        'group_id',
        'help_text',
        'input_help_text',
        'mandatory',
        'visible',
        'replacement_variable',
        'allows_options',
    ];

    public function setUp(): void
    {
        $this->subject = new ContainerAttributeConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            ContainerAttributeInterface::class,
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
