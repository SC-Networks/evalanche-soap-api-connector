<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowStateChangeResult;
use Scn\HydratorPropertyValues\Property\BooleanValue;

class WorkflowStateChangeResultConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new WorkflowStateChangeResult();
    }

    public function getHydratorProperties(): array
    {
        return [
            'state_change_successful' => BooleanValue::set('stateChangeSuccessful'),
            'errors' => ArrayOfObjectValue::set('errorList', new WorkflowStateChangeResultErrorConfig()),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'state_change_successful' => BooleanValue::get('stateChangeSuccessful'),
            'errors' => ArrayOfObjectValue::get('errorList'),
        ];
    }
}
