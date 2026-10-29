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

    public function add(int $mandatorId, string $email, string $description): void
    {
        $this->soapClient->add([
            'CustomerId' => $mandatorId,
            'Item' => [
                'Email' => $email,
                'Description' => $description
            ]
        ]);
    }

    public function remove(int $mandatorId, string $email): void
    {
        $this->soapClient->remove(['CustomerId' => $mandatorId, 'Email' => $email]);
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function get(int $mandatorId): BlackListInterface
    {
        return $this->responseMapper->getObjectDirectly(
            $this->soapClient->get(['CustomerId' => $mandatorId]),
            $this->hydratorConfigFactory->createBlackListConfig()
        );
    }

    public static function getWsdlUri(): string
    {
        return sprintf(ClientInterface::WSDL_V1_URI, self::VERSION, self::PORTNAME);
    }
}
