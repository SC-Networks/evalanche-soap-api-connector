<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Blacklist;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackListInterface;

/**
 * Interface BlackListClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Blacklist
 */
interface BlackListClientInterface extends ClientInterface
{
    public function add(int $mandatorId, string $email, string $description): void;

    public function remove(int $mandatorId, string $email): void;

    /**
     *
     * @throws EmptyResultException
     */
    public function get(int $mandatorId): BlackListInterface;
}
