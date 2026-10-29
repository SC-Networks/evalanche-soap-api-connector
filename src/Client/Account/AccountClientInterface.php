<?php

declare(strict_types=1);

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
     *
     * @throws EmptyResultException
     */
    public function getAccountByMandatorId(int $id): AccountInterface;
}
