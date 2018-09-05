<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Workflow;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowDetail;

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
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
            'date_start' => Property\IntegerValue::set('dateStart'),
            'date_end' => Property\IntegerValue::set('dateEnd'),
            'external_id' => Property\TextValue::set('externalId'),
            'category_id' => Property\IntegerValue::set('folderId'),
            'description' => Property\TextValue::set('description'),
            'state' => Property\IntegerValue::set('state'),
            'profile_count' => Property\IntegerValue::set('profileCount'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'name' => Property\TextValue::get('name'),
            'date_start' => Property\IntegerValue::get('dateStart'),
            'date_end' => Property\IntegerValue::get('dateEnd'),
            'external_id' => Property\TextValue::get('externalId'),
            'category_id' => Property\IntegerValue::get('folderId'),
            'description' => Property\TextValue::get('description'),
            'state' => Property\IntegerValue::get('state'),
            'profile_count' => Property\IntegerValue::get('profileCount'),
        ];
    }
}