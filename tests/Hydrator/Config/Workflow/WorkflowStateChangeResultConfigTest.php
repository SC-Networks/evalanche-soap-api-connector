<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowStateChangeResult;

class WorkflowStateChangeResultConfigTest extends TestCase
{
    /**
     * @var WorkflowStateChangeResultConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'state_change_successful',
        'errors',
    ];

    public function setUp(): void
    {
        $this->subject = new WorkflowStateChangeResultConfig();
    }

    public function testGetObjectCanReturnInstance(): void
    {
        self::assertInstanceOf(
            WorkflowStateChangeResult::class,
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
