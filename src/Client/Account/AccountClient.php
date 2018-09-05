<?php

namespace Scn\EvalancheSoapApiConnector\Client\Account;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Account\AccountInterface;

/**
 * Class AccountClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Account
 */
final class AccountClient extends AbstractClient implements AccountClientInterface
{
    const PORTNAME = 'accounting/wsdl';
    const VERSION = ClientInterface::VERSION_V1;

    /**
     * @param int $id
     *
     * @return AccountInterface
     * @throws EmptyResultException
     */
    public function getAccountByMandatorId(int $id): AccountInterface
    {
        return $this->responseMapper->getObjectDirectly(
            $this->soapClient->getAccount(['CustomerId' => $id]),
            $this->hydratorConfigFactory->createAccountConfig()
        );
    }

    /**
     *
     * @return string
     */
    public static function getWsdlUri(): string
    {
        return sprintf(ClientInterface::WSDL_V1_URI, static::VERSION, static::PORTNAME);
    }
}