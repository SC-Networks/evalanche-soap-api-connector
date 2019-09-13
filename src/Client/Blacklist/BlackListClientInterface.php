<?php

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
    /**
     * @param int $mandatorId
     * @param string $email
     * @param string $description
     *
     * @return void
     */
    public function add(int $mandatorId, string $email, string $description): void;

    /**
     * @param int $mandatorId
     * @param string $email
     *
     * @return void
     */
    public function remove(int $mandatorId, string $email): void;

    /**
     * @param int $mandatorId
     *
     * @return BlackListInterface
     * @throws EmptyResultException
     */
    public function get(int $mandatorId): BlackListInterface;
}
