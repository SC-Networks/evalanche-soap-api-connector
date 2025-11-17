<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\LeadPageTemplate;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlot;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

class LeadpageSlotConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new LeadpageSlot();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'slot_number' => IntegerValue::set('slotNumber'),
            'sort_type_id' => IntegerValue::set('sortTypeId'),
            'sort_type_value' => IntegerValue::set('sortTypeValue'),
            'items' => ArrayOfObjectValue::set('items', new LeadpageSlotItemConfig()),
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
