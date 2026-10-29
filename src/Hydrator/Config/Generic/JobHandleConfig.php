<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobHandle;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class JobHandleConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class JobHandleConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new JobHandle();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => StringValue::set('id'),
            'status' => IntegerValue::set('status'),
            'status_description' => StringValue::set('statusDescription'),
            'namespace' => StringValue::set('namespace'),
            'method' => StringValue::set('method'),
            'resource_id' => IntegerValue::set('resourceId'),
            'result_chunks' => IntegerValue::set('resultChunks'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'id' => StringValue::get('id'),
            'status' => IntegerValue::get('status'),
            'status_description' => StringValue::get('statusDescription'),
            'namespace' => StringValue::get('namespace'),
            'method' => StringValue::get('method'),
            'resource_id' => IntegerValue::get('resourceId'),
            'result_chunks' => IntegerValue::get('resultChunks'),
        ];
    }
}
