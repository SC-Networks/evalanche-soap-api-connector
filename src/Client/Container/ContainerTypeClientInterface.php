<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Container;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeGroupInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeOptionInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;

/**
 * Interface ContainerTypeClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Container
 */
interface ContainerTypeClientInterface extends ClientInterface, ResourceTraitInterface
{
    /**
     *
     * @throws EmptyResultException
     */
    public function addAttribute(
        int $id,
        string $title,
        string $label,
        int $typeId,
        int $groupId
    ): ContainerAttributeInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function addAttributeGroup(int $id, string $title): ContainerAttributeGroupInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function updateAttributeType(int $id, int $attributeId, int $typeId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function addAttributeOption(int $id, int $attributeId, string $label): ContainerAttributeOptionInterface;

    /**
     *
     * @return ContainerAttributeGroupInterface[]
     * @throws EmptyResultException
     */
    public function getAttributeGroupsByResourceId(int $id): array;

    /**
     *
     * @return ContainerAttributeOptionInterface[]
     * @throws EmptyResultException
     */
    public function getAttributeOptionsByResourceIdAndAttributeId(int $id, int $attributeId): array;

    /**
     *
     * @return ContainerAttributeInterface[]
     * @throws EmptyResultException
     */
    public function getAttributesByResourceId(int $id): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function removeAttribute(int $id, int $attributeId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function removeAttributeGroup(int $id, int $attributeGroupId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function removeAttributeOption(int $id, int $attributeId, int $optionId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function updateAttribute(int $id, int $attributeId, HashMapInterface $hashMap): ContainerAttributeInterface;
}
