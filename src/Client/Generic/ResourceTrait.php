<?php

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\CategoryInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceTypeInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ServiceStatusInterface;

/**
 * Trait ResourceTrait
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Generic
 */
trait ResourceTrait
{
    /**
     * @param int $id
     * @param int $categoryId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function copy(int $id, int $categoryId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->copy(['resource_id' => $id, 'category_id' => $categoryId]),
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
    public function getByCategoryId(int $id): array
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
     * @return CategoryInformationInterface
     * @throws EmptyResultException
     */
    public function getDefaultCategoryByCustomerId(int $id): CategoryInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getResourceDefaultCategory(['customer_id' => $id]),
            'getResourceDefaultCategoryResult',
            $this->hydratorConfigFactory->createCategoryInformationConfig()
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
     * @param int $categoryId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function move(int $id, int $categoryId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->move(['resource_id' => $id, 'category_id' => $categoryId]),
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