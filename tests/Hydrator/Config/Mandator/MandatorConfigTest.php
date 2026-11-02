<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mandator;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mandator\MandatorInterface;

/**
 * Class MandatorConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mandator
 */
class MandatorConfigTest extends TestCase
{
    private MandatorConfig $subject;

    private array $arrayKeys = [
        'id',
        'name',
        'domain'
    ];

    public function setUp(): void
    {
        $this->subject = new MandatorConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            MandatorInterface::class,
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
