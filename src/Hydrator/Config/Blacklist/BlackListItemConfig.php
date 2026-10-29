<?php

declare(strict_types=1);

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
    public function getObject(): StructInterface
    {
        return new BlackListItem();
    }

    public function getHydratorProperties(): array
    {
        return [
            'Email' => StringValue::set('email'),
            'Description' => StringValue::set('description'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'Email' => StringValue::get('email'),
            'Description' => StringValue::get('description'),
        ];
    }
}
