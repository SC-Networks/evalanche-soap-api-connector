<?php

declare(strict_types=1);

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
    public function getObject(): StructInterface
    {
        return new ContainerDetail();
    }

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
