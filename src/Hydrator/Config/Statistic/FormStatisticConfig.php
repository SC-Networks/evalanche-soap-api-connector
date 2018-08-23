<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\FormStatistic;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class FormStatisticConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class FormStatisticConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new FormStatistic();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
            'is_alias' => Property\BooleanValue::set('isAlias'),
            'impressions' => Property\IntegerValue::set('impressions'),
            'succeeded' => Property\IntegerValue::set('succeeded'),
            'identity_errors' => Property\IntegerValue::set('identityErrorCount'),
            'duplication_errors' => Property\IntegerValue::set('duplicationErrorĆount'),
            'validation_errors' => Property\IntegerValue::set('validationErrorCount'),
            'mandatory_errors' => Property\IntegerValue::set('mandatoryErrorCount'),
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
            'is_alias' => Property\BooleanValue::get('isAlias'),
            'impressions' => Property\IntegerValue::get('impressions'),
            'succeeded' => Property\IntegerValue::get('succeeded'),
            'identity_errors' => Property\IntegerValue::get('identityErrorCount'),
            'duplication_errors' => Property\IntegerValue::get('duplicationErrorĆount'),
            'validation_errors' => Property\IntegerValue::get('validationErrorCount'),
            'mandatory_errors' => Property\IntegerValue::get('mandatoryErrorCount'),
        ];
    }
}