<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Blacklist;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackListItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'Email' => Property\TextValue::set('email'),
            'Description' => Property\TextValue::set('description'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'Email' => Property\TextValue::get('email'),
            'Description' => Property\TextValue::get('description'),
        ];
    }
}