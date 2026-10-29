<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use DateTimeInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
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
    public function copy(int $id, int $folderId): ResourceInformationInterface;

    public function delete(int $id): bool;

    /**
     *
     * @return ResourceInformationInterface[]
     */
    public function getListByMandatorId(int $id): array;

    /**
     *
     * @return ResourceInformationInterface[]
     */
    public function getByFolderId(int $id): array;

    public function getByExternalId(string $id): ResourceInformationInterface;

    public function getById(int $id): ResourceInformationInterface;

    /**
     *
     * @return ResourceInformationInterface[]
     */
    public function getByTypeId(int $id, int $mandatorId): array;

    public function getDefaultFolderByMandatorId(int $id): FolderInformationInterface;

    /**
     *
     * @return ResourceTypeInformationInterface[]
     */
    public function getTypeIds(): array;

    public function move(int $id, int $folderId): ResourceInformationInterface;

    public function getServiceAvailable(): ServiceStatusInterface;

    public function updateTitle(int $id, string $title): ResourceInformationInterface;

    /**
     * Returns all items having a modification-date in the given time-range
     *
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByModificationDate(
        DateTimeInterface $startDate,
        DateTimeInterface $endDate,
        int $mandator_id = 0,
    ): array;
}
