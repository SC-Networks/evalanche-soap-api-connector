<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowConfiguration;
use Scn\HydratorPropertyValues\Property\StringValue;

final class WorkflowConfigurationConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new WorkflowConfiguration();
    }

    public function getHydratorProperties(): array
    {
        return [
            'config_version' => StringValue::set('configVersion'),
            'configuration' => StringValue::set('configuration'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'config_version' => StringValue::get('configVersion'),
            'configuration' => StringValue::get('configuration'),
        ];
    }
}
