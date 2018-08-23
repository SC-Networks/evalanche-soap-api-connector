<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Scoring;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Scoring\ScoringGroupDetail;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
            'mandator_id' => Property\IntegerValue::set('mandatorId'),
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
            'mandator_id' => Property\IntegerValue::get('mandatorId'),
        ];
    }
}