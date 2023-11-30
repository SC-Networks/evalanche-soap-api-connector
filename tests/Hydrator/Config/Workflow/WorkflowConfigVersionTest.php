<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowConfigVersion;

class WorkflowConfigVersionTest extends TestCase
{
    /**
     * @var WorkflowConfigVersion
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'config_version',
        'create_date',
        'latest',
    ];

    public function setUp(): void
    {
        $this->subject = new WorkflowConfigVersionConfig();
    }

    public function testGetObjectCanReturnInstance(): void
    {
        self::assertInstanceOf(
            WorkflowConfigVersion::class,
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
