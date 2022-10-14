<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Generic\JobResult;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class JobResultConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class JobResultConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new JobResult();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => StringValue::set('id'),
            'status' => IntegerValue::set('status'),
            'status_description' => StringValue::set('statusDescription'),
            'namespace' => StringValue::set('namespace'),
            'method' => StringValue::set('method'),
            'resource_id' => IntegerValue::set('resourceId'),
            'result_chunks' => IntegerValue::set('resultCunks'),
            'result' => Property\ArrayOfObjectValue::set('result', new HashMapConfig()),
            'chunks_left' => IntegerValue::set('chunksLeft'),
            'result_size' => IntegerValue::set('resultSize'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => StringValue::get('id'),
            'status' => IntegerValue::get('status'),
            'status_description' => StringValue::get('statusDescription'),
            'namespace' => StringValue::get('namespace'),
            'method' => StringValue::get('method'),
            'resource_id' => IntegerValue::get('resourceId'),
            'result_chunks' => IntegerValue::get('resultCunks'),
            'result' => Property\ArrayOfObjectValue::get('result'),
            'chunks_left' => IntegerValue::get('chunksLeft'),
            'result_size' => IntegerValue::get('resultSize'),
        ];
    }
}
