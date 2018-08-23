<?php

namespace Scn\EvalancheSoapApiConnector\Client\Account;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Account\AccountInterface;

/**
 * Interface AccountClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Account
 */
interface AccountClientInterface extends ClientInterface
{
    /**
     * @param int $id
     *
     * @return AccountInterface
     * @throws EmptyResultException
     */
    public function getAccountByCustomerId(int $id): AccountInterface;
}