<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowDetailInterface;

/**
 * Class WorkflowDetailConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Workflow
 */
class WorkflowDetailConfigTest extends TestCase
{
    private WorkflowDetailConfig $subject;

    private array $arrayKeys = [
        'id',
        'name',
        'date_start',
        'date_end',
        'external_id',
        'category_id',
        'description',
        'state',
        'profile_count',
    ];

    public function setUp(): void
    {
        $this->subject = new WorkflowDetailConfig();
    }

    public function testGetObjectCanReturnInstanceOfWorkflowDetail(): void
    {
        self::assertInstanceOf(
            WorkflowDetailInterface::class,
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
