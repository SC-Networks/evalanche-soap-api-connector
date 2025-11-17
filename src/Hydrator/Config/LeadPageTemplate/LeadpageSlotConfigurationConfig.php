<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\LeadPageTemplate;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotConfiguration;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

class LeadpageSlotConfigurationConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new LeadpageSlotConfiguration();
    }

    public function getHydratorProperties(): array
    {
        return [
            'items' => ArrayOfObjectValue::set('items', new LeadpageSlotConfig())
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'items' => ArrayOfObjectValue::get('items')
        ];
    }
}
