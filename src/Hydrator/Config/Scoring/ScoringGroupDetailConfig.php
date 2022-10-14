<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Scoring;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Scoring\ScoringGroupDetail;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class ScoringGroupDetailConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Scoring
 */
class ScoringGroupDetailConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ScoringGroupDetail();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'mandator_id' => IntegerValue::set('mandatorId'),
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
            'mandator_id' => IntegerValue::get('mandatorId'),
        ];
    }
}
