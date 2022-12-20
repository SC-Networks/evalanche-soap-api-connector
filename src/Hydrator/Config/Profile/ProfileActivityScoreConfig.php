<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Profile;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Profile\ProfileActivityScore;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

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
            'id' => IntegerValue::set('id'),
            'scoring_group_id' => IntegerValue::set('scoringGroupId'),
            'scoring_type_id' => IntegerValue::set('scoringTypeId'),
            'timestamp' => IntegerValue::set('timestamp'),
            'value' => IntegerValue::set('score'),
            'resource_id' => IntegerValue::set('resourceId'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'scoring_group_id' => IntegerValue::get('scoringGroupId'),
            'scoring_type_id' => IntegerValue::get('scoringTypeId'),
            'timestamp' => IntegerValue::get('timestamp'),
            'value' => IntegerValue::get('score'),
            'resource_id' => IntegerValue::get('resourceId'),
        ];
    }
}
