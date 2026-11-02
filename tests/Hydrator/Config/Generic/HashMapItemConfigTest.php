<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapItemInterface;

/**
 * Class HashMapItemConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic
 */
class HashMapItemConfigTest extends TestCase
{
    /**
     * @var HashMapConfig
     */
    private HashMapItemConfig $subject;

    private array $arrayKeys = [
        'key',
        'value'
    ];

    public function setUp(): void
    {
        $this->subject = new HashMapItemConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            HashMapItemInterface::class,
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
