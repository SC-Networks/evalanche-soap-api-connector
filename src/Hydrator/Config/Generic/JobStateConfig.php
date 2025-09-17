<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobState;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class JobStateConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new JobState();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => StringValue::set('id'),
            'status' => IntegerValue::set('status'),
            'status_description' => StringValue::set('statusDescription'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => StringValue::get('id'),
            'status' => IntegerValue::get('status'),
            'status_description' => StringValue::get('statusDescription'),
        ];
    }
}
