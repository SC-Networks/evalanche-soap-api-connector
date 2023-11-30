<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\MassUpdateResultInterface;

/**
 * Class MassUpdateResultConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class MassUpdateResultConfigTest extends TestCase
{
    /**
     * @var MassUpdateResultConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'updated',
        'created',
        'ignored',
        'error',
    ];

    public function setUp(): void
    {
        $this->subject = new MassUpdateResultConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            MassUpdateResultInterface::class,
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
