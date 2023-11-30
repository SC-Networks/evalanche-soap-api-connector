<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowStateChangeResultError;

class WorkflowStateChangeResultErrorConfigTest extends TestCase
{
    /**
     * @var WorkflowStateChangeResultErrorConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'type',
        'node',
        'param',
    ];

    public function setUp(): void
    {
        $this->subject = new WorkflowStateChangeResultErrorConfig();
    }

    public function testGetObjectCanReturnInstance(): void
    {
        self::assertInstanceOf(
            WorkflowStateChangeResultError::class,
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
