<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowConfigVersion;
use Scn\HydratorPropertyValues\Property\BooleanValue;
use Scn\HydratorPropertyValues\Property\StringValue;

class WorkflowConfigVersionConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new WorkflowConfigVersion();
    }

    public function getHydratorProperties(): array
    {
        return [
            'config_version' => StringValue::set('configVersion'),
            'create_date' => StringValue::set('createDate'),
            'latest' => BooleanValue::set('latest'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'config_version' => StringValue::get('configVersion'),
            'create_date' => StringValue::get('createDate'),
            'latest' => BooleanValue::get('latest'),
        ];
    }
}
