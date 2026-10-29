<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Webhook;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;

/**
 * Interface WebhookClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Webhook
 */
interface WebhookClientInterface extends ClientInterface
{
    public function trigger(int $id, int $profileId): void;
}
