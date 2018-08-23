<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Generic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformation;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'url' => Property\TextValue::set('url'),
            'type_id' => Property\IntegerValue::set('typeId'),
            'category_id' => Property\IntegerValue::set('categoryId'),
            'customer_id' => Property\IntegerValue::set('customerId'),
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name')
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'url' => Property\TextValue::get('url'),
            'type_id' => Property\IntegerValue::get('typeId'),
            'category_id' => Property\IntegerValue::get('categoryId'),
            'customer_id' => Property\IntegerValue::get('customerId'),
            'id' => Property\IntegerValue::get('id'),
            'name' => Property\TextValue::get('name')
        ];
    }
}