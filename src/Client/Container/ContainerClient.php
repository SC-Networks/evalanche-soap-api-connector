<?php

namespace Scn\EvalancheSoapApiConnector\Client\Container;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerDetailInterface;
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

    const PORTNAME = 'container';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     * @param string $title
     * @param int $folderId
     * @param HashMapInterface $hashMap
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(
        int $id,
        string $title,
        int $folderId,
        HashMapInterface $hashMap
    ): ResourceInformationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->create(
                [
                    'container_preset_id' => $id,
                    'name' => $title,
                    'category_id' => $folderId,
                    'data' => $this->extractor->extract(
                        $this->hydratorConfigFactory->createHashMapConfig(),
                        $hashMap
                    ),
                ]
            ),
            'createResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

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

    /**
     * @param int $id
     *
     * @return ContainerDetailInterface
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): ContainerDetailInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getDetails(
                [
                    'container_id' => $id,
                ]
            ),
            'getDetailsResult',
            $this->hydratorConfigFactory->createContainerDetailConfig()
        );
    }

    /**
     * @param int $containerTypeId
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByContainerTypeId(int $containerTypeId): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getByContainerTypeId(
                [
                    'container_type_id' => $containerTypeId,
                ]
            ),
            'getByContainerTypeIdResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }
}
