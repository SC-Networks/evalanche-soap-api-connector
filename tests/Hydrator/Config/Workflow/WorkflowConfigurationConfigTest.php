<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowConfiguration;

class WorkflowConfigurationConfigTest extends TestCase
{
    /**
     * @var WorkflowConfigurationConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'config_version',
        'configuration',
    ];

    public function setUp(): void
    {
        $this->subject = new WorkflowConfigurationConfig();
    }

    public function testGetObjectCanReturnInstance(): void
    {
        self::assertInstanceOf(
            WorkflowConfiguration::class,
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
