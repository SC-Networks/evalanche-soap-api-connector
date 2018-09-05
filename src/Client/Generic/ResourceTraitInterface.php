<?php

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceTypeInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ServiceStatusInterface;

/**
 * Interface ResourceTraitInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Generic
 */
interface ResourceTraitInterface
{
    /**
     * @param int $id
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     */
    public function copy(int $id, int $folderId): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface[]
     */
    public function getListByMandatorId(int $id): array;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface[]
     */
    public function getByFolderId(int $id): array;

    /**
     * @param string $id
     *
     * @return ResourceInformationInterface
     */
    public function getByExternalId(string $id): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface
     */
    public function getById(int $id): ResourceInformationInterface;

    /**
     * @param int $id
     * @param int $mandatorId
     *
     * @return ResourceInformationInterface[]
     */
    public function getByTypeId(int $id, int $mandatorId): array;

    /**
     * @param int $id
     *
     * @return FolderInformationInterface
     */
    public function getDefaultFolderByMandatorId(int $id): FolderInformationInterface;

    /**
     *
     * @return ResourceTypeInformationInterface[]
     */
    public function getTypeIds(): array;

    /**
     * @param int $id
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     */
    public function move(int $id, int $folderId): ResourceInformationInterface;

    /**
     *
     * @return ServiceStatusInterface
     */
    public function getServiceAvailable(): ServiceStatusInterface;
}