<?php

namespace Scn\EvalancheSoapApiConnector\Client\Webhook;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;

/**
 * Class WebhookClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Webhook
 */
final class WebhookClient extends AbstractClient implements WebhookClientInterface
{
    const PORTNAME = 'webhook/wsdl';
    const VERSION = ClientInterface::VERSION_V1;

    public function trigger(int $id, int $profileId): void
    {
        $this->soapClient->trigger(['webhookId' => $id, 'profileId' => $profileId]);
    }

    public static function getWsdlUri(): string
    {
        return sprintf(ClientInterface::WSDL_V1_URI, self::VERSION, self::PORTNAME);
    }
}
