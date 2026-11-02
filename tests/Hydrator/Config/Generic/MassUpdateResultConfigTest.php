<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\MassUpdateResultInterface;

/**
 * Class MassUpdateResultConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class MassUpdateResultConfigTest extends TestCase
{
    private MassUpdateResultConfig $subject;

    private array $arrayKeys = [
        'updated',
        'created',
        'ignored',
        'error',
    ];

    public function setUp(): void
    {
        $this->subject = new MassUpdateResultConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            MassUpdateResultInterface::class,
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
