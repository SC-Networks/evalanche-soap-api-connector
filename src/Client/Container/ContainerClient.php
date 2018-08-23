<?php

namespace Scn\EvalancheSoapApiConnector\Client\Container;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTrait;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Class ContainerClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Container
 */
final class ContainerClient extends AbstractClient implements ContainerClientInterface
{
    use ResourceTrait;
    use CreateResourceTrait;

    const PORTNAME = 'container';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     *
     * @return HashMapInterface
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): HashMapInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getData([
                'container_id' => $id
            ]),
            'getDataResult',
            $this->hydratorConfigFactory->createHashMapConfig()
        );
    }

    /**
     * @param int $id
     * @param HashMapInterface $hashMap
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function update(int $id, HashMapInterface $hashMap): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->update([
                'container_id' => $id,
                'data' => $this->extractor->extract(
                    $this->hydratorConfigFactory->createHashMapConfig(),
                    $hashMap
                )
            ]),
            'updateResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }
}