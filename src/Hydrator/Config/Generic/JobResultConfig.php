<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Generic\JobResult;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'id' => Property\TextValue::set('id'),
            'status' => Property\IntegerValue::set('status'),
            'status_description' => Property\TextValue::set('statusDescription'),
            'namespace' => Property\TextValue::set('namespace'),
            'method' => Property\TextValue::set('method'),
            'resource_id' => Property\IntegerValue::set('resourceId'),
            'result_chunks' => Property\IntegerValue::set('resultCunks'),
            'result' => Property\ArrayOfObjectValue::set('result', new HashMapConfig()),
            'chunks_left' => Property\IntegerValue::set('chunksLeft'),
            'result_size' => Property\IntegerValue::set('resultSize'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\TextValue::get('id'),
            'status' => Property\IntegerValue::get('status'),
            'status_description' => Property\TextValue::get('statusDescription'),
            'namespace' => Property\TextValue::get('namespace'),
            'method' => Property\TextValue::get('method'),
            'resource_id' => Property\IntegerValue::get('resourceId'),
            'result_chunks' => Property\IntegerValue::get('resultCunks'),
            'result' => Property\ArrayOfObjectValue::get('result', new HashMapConfig()),
            'chunks_left' => Property\IntegerValue::get('chunksLeft'),
            'result_size' => Property\IntegerValue::get('resultSize'),
        ];
    }
}