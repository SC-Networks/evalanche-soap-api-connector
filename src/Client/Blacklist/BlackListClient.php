<?php

namespace Scn\EvalancheSoapApiConnector\Client\Blacklist;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Blacklist\BlackListInterface;

/**
 * Class BlackListClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Blacklist
 */
final class BlackListClient extends AbstractClient implements BlackListClientInterface
{
    const PORTNAME = 'blacklist/wsdl';
    const VERSION = ClientInterface::VERSION_V1;

    /**
     * @param int $customerId
     * @param string $email
     * @param string $description
     *
     * @return void
     */
    public function add(int $customerId, string $email, string $description): void
    {
        $this->soapClient->add([
            'CustomerId' => $customerId,
            'Item' => [
                'Email' => $email,
                'Description' => $description
            ]
        ]);
    }

    /**
     * @param int $customerId
     * @param string $email
     *
     * @return void
     */
    public function remove(int $customerId, string $email): void
    {
        $this->soapClient->remove(['CustomerId' => $customerId, 'Email' => $email]);
    }

    /**
     * @param int $customerId
     *
     * @return BlackListInterface
     * @throws EmptyResultException
     */
    public function get(int $customerId): BlackListInterface
    {
        return $this->responseMapper->getObjectDirectly(
            $this->soapClient->get(['CustomerId' => $customerId]),
            $this->hydratorConfigFactory->createBlackListConfig()
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