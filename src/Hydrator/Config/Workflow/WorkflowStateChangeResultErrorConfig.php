<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowStateChangeResultError;
use Scn\HydratorPropertyValues\Property\StringValue;

class WorkflowStateChangeResultErrorConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new WorkflowStateChangeResultError();
    }

    public function getHydratorProperties(): array
    {
        return [
            'type' => StringValue::set('type'),
            'node' => StringValue::set('node'),
            'param' => StringValue::set('param'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'type' => StringValue::get('type'),
            'node' => StringValue::get('node'),
            'param' => StringValue::get('param'),
        ];
    }
}
