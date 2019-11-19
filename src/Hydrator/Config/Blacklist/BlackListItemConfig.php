<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackListItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class BlackListItemConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist
 */
class BlackListItemConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new BlackListItem();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'Email' => StringValue::set('email'),
            'Description' => StringValue::set('description'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'Email' => StringValue::get('email'),
            'Description' => StringValue::get('description'),
        ];
    }
}
