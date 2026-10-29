<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Container;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerDetailInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Interface ContainerClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Container
 */
interface ContainerClientInterface extends ClientInterface, ResourceTraitInterface
{
    /**
     *
     * @throws EmptyResultException
     */
    public function create(
        int $id,
        string $title,
        int $folderId,
        HashMapInterface $hashMap
    ): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): HashMapInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function update(int $id, HashMapInterface $hashMap): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): ContainerDetailInterface;

    /**
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByContainerTypeId(int $containerTypeId): array;
}
