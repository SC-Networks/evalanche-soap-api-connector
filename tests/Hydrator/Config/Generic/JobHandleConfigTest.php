<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\JobHandleInterface;

/**
 * Class JobHandleConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class JobHandleConfigTest extends TestCase
{
    private JobHandleConfig $subject;

    private array $arrayKeys = [
        'id',
        'status',
        'status_description',
        'namespace',
        'method',
        'resource_id',
        'result_chunks',
    ];

    public function setUp(): void
    {
        $this->subject = new JobHandleConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser(): void
    {
        self::assertInstanceOf(
            JobHandleInterface::class,
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
