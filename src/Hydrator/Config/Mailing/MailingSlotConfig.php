<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlot;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

class MailingSlotConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new MailingSlot();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'slot_number' => IntegerValue::set('slotNumber'),
            'sort_type_id' => IntegerValue::set('sortTypeId'),
            'sort_type_value' => IntegerValue::set('sortTypeValue'),
            'items' => ArrayOfObjectValue::set('items', new MailingSlotItemConfig()),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'name' => StringValue::get('name'),
            'slot_number' => IntegerValue::get('slotNumber'),
            'sort_type_id' => IntegerValue::get('sortTypeId'),
            'sort_type_value' => IntegerValue::get('sortTypeValue'),
            'items' => ArrayOfObjectValue::get('items'),
        ];
    }
}