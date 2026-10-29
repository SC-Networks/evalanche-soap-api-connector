<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayOfObjectValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\ClientStatistic;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class ClientStatisticConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class ClientStatisticConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new ClientStatistic();
    }

    public function getHydratorProperties(): array
    {
        return [
            'mail_clients' => ArrayOfObjectValue::set('clients', new MailClientStatisticItemConfig()),
            'browsers' => ArrayOfObjectValue::set('browsers', new BrowserStatisticItemConfig()),
            'devices' => ArrayOfObjectValue::set('devices', new MailClientStatisticItemConfig()),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'mail_clients' => ArrayOfObjectValue::set('clients', new MailClientStatisticItemConfig()),
            'browsers' => ArrayOfObjectValue::set('browsers', new BrowserStatisticItemConfig()),
            'devices' => ArrayOfObjectValue::set('devices', new MailClientStatisticItemConfig()),
        ];
    }
}
