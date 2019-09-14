<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mandator;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Mandator\MandatorInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class MandatorClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mandator
 */
final class MandatorClient extends AbstractClient implements MandatorClientInterface
{
    const PORTNAME = 'mandator';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     *
     * @return MandatorInterface|StructInterface
     * @throws EmptyResultException
     */
    public function getById(int $id): StructInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getById(['mandator_id' => $id]),
            'getByIdResult',
            $this->hydratorConfigFactory->createMandatorConfig()
        );
    }

    /**
     *
     * @return MandatorInterface[]
     * @throws EmptyResultException
     */
    public function getList(): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getList(),
            'getListResult',
            $this->hydratorConfigFactory->createMandatorConfig()
        );
    }
}
