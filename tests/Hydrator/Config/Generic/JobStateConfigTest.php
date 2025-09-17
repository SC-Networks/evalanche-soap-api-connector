<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Generic\JobStateInterface;

class JobStateConfigTest extends TestCase
{
    private JobStateConfig $subject;

    /** @var list<string> */
    private array $arrayKeys = [
        'id',
        'status',
        'status_description',
    ];

    public function setUp(): void
    {
        $this->subject = new JobStateConfig();
    }

    public function testGetObjectCanReturnInstanceOfJobState(): void
    {
        self::assertInstanceOf(
            JobStateInterface::class,
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
