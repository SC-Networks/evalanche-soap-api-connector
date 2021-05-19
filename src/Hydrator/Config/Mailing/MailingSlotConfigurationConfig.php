<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotConfiguration;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

class MailingSlotConfigurationConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new MailingSlotConfiguration();
    }

    public function getHydratorProperties(): array
    {
        return [
            'items' => ArrayOfObjectValue::set('items', new MailingSlotConfig())
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'items' => ArrayOfObjectValue::get('items')
        ];
    }
}
