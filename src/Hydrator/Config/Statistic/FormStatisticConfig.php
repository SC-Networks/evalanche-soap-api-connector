<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\FormStatistic;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\BooleanValue;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

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
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'is_alias' => BooleanValue::set('isAlias'),
            'impressions' => IntegerValue::set('impressions'),
            'succeeded' => IntegerValue::set('succeeded'),
            'identity_errors' => IntegerValue::set('identityErrorCount'),
            'duplication_errors' => IntegerValue::set('duplicationErrorCount'),
            'validation_errors' => IntegerValue::set('validationErrorCount'),
            'mandatory_errors' => IntegerValue::set('mandatoryErrorCount'),
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
            'is_alias' => BooleanValue::get('isAlias'),
            'impressions' => IntegerValue::get('impressions'),
            'succeeded' => IntegerValue::get('succeeded'),
            'identity_errors' => IntegerValue::get('identityErrorCount'),
            'duplication_errors' => IntegerValue::get('duplicationErrorCount'),
            'validation_errors' => IntegerValue::get('validationErrorCount'),
            'mandatory_errors' => IntegerValue::get('mandatoryErrorCount'),
        ];
    }
}
