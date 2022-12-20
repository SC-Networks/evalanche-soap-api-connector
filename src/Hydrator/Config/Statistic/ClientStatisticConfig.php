<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Statistic\ClientStatistic;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class ClientStatisticConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Statistic
 */
class ClientStatisticConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new ClientStatistic();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'mail_clients' => Property\ArrayOfObjectValue::set('clients', new MailClientStatisticItemConfig()),
            'browsers' => Property\ArrayOfObjectValue::set('browsers', new BrowserStatisticItemConfig()),
            'devices' => Property\ArrayOfObjectValue::set('devices', new MailClientStatisticItemConfig()),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'mail_clients' => Property\ArrayOfObjectValue::set('clients', new MailClientStatisticItemConfig()),
            'browsers' => Property\ArrayOfObjectValue::set('browsers', new BrowserStatisticItemConfig()),
            'devices' => Property\ArrayOfObjectValue::set('devices', new MailClientStatisticItemConfig()),
        ];
    }
}
