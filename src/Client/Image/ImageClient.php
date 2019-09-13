<?php

namespace Scn\EvalancheSoapApiConnector\Client\Image;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceTypeInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ServiceStatusInterface;

/**
 * Class ImageClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Image
 */
final class ImageClient extends AbstractClient implements ImageClientInterface
{
    const PORTNAME = 'image';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param string $image
     * @param string $title
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(string $image, string $title, int $folderId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->create(['image_base64' => $image, 'name' => $title, 'category_id' => $folderId]),
            'createResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function copy(int $id, int $folderId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->copy(['resource_id' => $id, 'category_id' => $folderId]),
            'copyResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function delete(int $id): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->delete(['resource_id' => $id]),
            'deleteResult'
        );
    }

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getListByMandatorId(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getAll(['mandator_id' => $id]),
            'getAllResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByFolderId(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getByCategory(['category_id' => $id]),
            'getByCategoryResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param string $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getByExternalId(string $id): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getByExternalId(['external_id' => $id]),
            'getByExternalIdResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getById(int $id): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getById(['resource_id' => $id]),
            'getByIdResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param int $mandatorId
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByTypeId(int $id, int $mandatorId): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getByTypeId(['type_id' => $id, 'mandator_id' => $mandatorId]),
            'getByTypeIdResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return FolderInformationInterface
     * @throws EmptyResultException
     */
    public function getDefaultFolderByMandatorId(int $id): FolderInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getResourceDefaultCategory(['customer_id' => $id]),
            'getResourceDefaultCategoryResult',
            $this->hydratorConfigFactory->createFolderInformationConfig()
        );
    }

    /**
     *
     * @return ResourceTypeInformationInterface[]
     * @throws EmptyResultException
     */
    public function getTypeIds(): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getTypeIds(),
            'getTypeIdsResult',
            $this->hydratorConfigFactory->createResourceTypeInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function move(int $id, int $folderId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->move(['resource_id' => $id, 'category_id' => $folderId]),
            'moveResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     *
     * @return ServiceStatusInterface
     * @throws EmptyResultException
     */
    public function getServiceAvailable(): ServiceStatusInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->isAlive(),
            'isAliveResult',
            $this->hydratorConfigFactory->createServiceStatusConfig()
        );
    }
}
