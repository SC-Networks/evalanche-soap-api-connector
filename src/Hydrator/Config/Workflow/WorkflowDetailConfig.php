<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowDetail;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class WorkflowDetailConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Workflow
 */
final class WorkflowDetailConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new WorkflowDetail();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'date_start' => IntegerValue::set('dateStart'),
            'date_end' => IntegerValue::set('dateEnd'),
            'external_id' => StringValue::set('externalId'),
            'category_id' => IntegerValue::set('folderId'),
            'description' => StringValue::set('description'),
            'state' => IntegerValue::set('state'),
            'profile_count' => IntegerValue::set('profileCount'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'name' => StringValue::get('name'),
            'date_start' => IntegerValue::get('dateStart'),
            'date_end' => IntegerValue::get('dateEnd'),
            'external_id' => StringValue::get('externalId'),
            'category_id' => IntegerValue::get('folderId'),
            'description' => StringValue::get('description'),
            'state' => IntegerValue::get('state'),
            'profile_count' => IntegerValue::get('profileCount'),
        ];
    }
}
