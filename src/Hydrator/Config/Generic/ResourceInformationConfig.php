<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformation;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class ResourceInformationConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Generic
 */
class ResourceInformationConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ResourceInformation();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'url' => StringValue::set('url'),
            'type_id' => IntegerValue::set('typeId'),
            'category_id' => IntegerValue::set('folderId'),
            'customer_id' => IntegerValue::set('mandatorId'),
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'url' => StringValue::get('url'),
            'type_id' => IntegerValue::get('typeId'),
            'category_id' => IntegerValue::get('folderId'),
            'customer_id' => IntegerValue::get('mandatorId'),
            'id' => IntegerValue::get('id'),
            'name' => StringValue::get('name')
        ];
    }
}
