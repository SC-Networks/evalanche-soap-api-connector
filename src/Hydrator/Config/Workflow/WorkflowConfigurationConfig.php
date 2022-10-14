<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowConfiguration;
use Scn\HydratorPropertyValues\Property\StringValue;

final class WorkflowConfigurationConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new WorkflowConfiguration();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'config_version' => StringValue::set('configVersion'),
            'configuration' => StringValue::set('configuration'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'config_version' => StringValue::get('configVersion'),
            'configuration' => StringValue::get('configuration'),
        ];
    }
}
