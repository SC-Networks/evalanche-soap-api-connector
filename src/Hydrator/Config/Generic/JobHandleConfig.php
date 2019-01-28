<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Generic\JobHandle;
use Scn\EvalancheSoapStruct\Struct\StructInterface;


/**
 * Class JobHandleConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class JobHandleConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new JobHandle();
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
            'result_chunks' => Property\IntegerValue::set('resultChunks'),
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
            'result_chunks' => Property\IntegerValue::get('resultChunks'),
        ];
    }
}