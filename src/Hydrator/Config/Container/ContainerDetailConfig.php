<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Container;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerDetail;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class ContainerDetailConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Container
 */
class ContainerDetailConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ContainerDetail();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'url' => StringValue::set('url'),
            'type_id' => IntegerValue::set('typeId'),
            'category_id' => IntegerValue::set('folderId'),
            'customer_id' => IntegerValue::set('mandatorId'),
            'container_type_id' => IntegerValue::set('containerTypeId'),
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
            'url' => StringValue::get('url'),
            'type_id' => IntegerValue::get('typeId'),
            'category_id' => IntegerValue::get('folderId'),
            'customer_id' => IntegerValue::get('mandatorId'),
            'container_type_id' => IntegerValue::get('containerTypeId'),
        ];
    }
}
