<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileActivityScore;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class ProfileActivityScoreConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Profile
 */
class ProfileActivityScoreConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ProfileActivityScore();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'scoring_group_id' => Property\IntegerValue::set('scoringGroupId'),
            'scoring_type_id' => Property\IntegerValue::set('scoringTypeId'),
            'timestamp' => Property\IntegerValue::set('timestamp'),
            'value' => Property\IntegerValue::set('score'),
            'resource_id' => Property\IntegerValue::set('resourceId'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'scoring_group_id' => Property\IntegerValue::get('scoringGroupId'),
            'scoring_type_id' => Property\IntegerValue::get('scoringTypeId'),
            'timestamp' => Property\IntegerValue::get('timestamp'),
            'value' => Property\IntegerValue::get('score'),
            'resource_id' => Property\IntegerValue::get('resourceId'),
        ];
    }
}