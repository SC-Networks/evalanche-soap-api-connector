<?php

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
     * @param int $id
     * @param string $title
     * @param string $label
     * @param int $typeId
     * @param int $groupId
     *
     * @return ContainerAttributeInterface
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
     * @param int $id
     * @param string $title
     *
     * @return ContainerAttributeGroupInterface
     * @throws EmptyResultException
     */
    public function addAttributeGroup(int $id, string $title): ContainerAttributeGroupInterface;

    /**
     * @param int $id
     * @param int $attributeId
     * @param int $typeId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function updateAttributeType(int $id, int $attributeId, int $typeId): bool;

    /**
     * @param int $id
     * @param int $attributeId
     * @param string $label
     *
     * @return ContainerAttributeOptionInterface
     * @throws EmptyResultException
     */
    public function addAttributeOption(int $id, int $attributeId, string $label): ContainerAttributeOptionInterface;

    /**
     * @param int $id
     *
     * @return ContainerAttributeGroupInterface[]
     * @throws EmptyResultException
     */
    public function getAttributeGroupsByResourceId(int $id): array;

    /**
     * @param int $id
     * @param int $attributeId
     *
     * @return ContainerAttributeOptionInterface[]
     * @throws EmptyResultException
     */
    public function getAttributeOptionsByResourceIdAndAttributeId(int $id, int $attributeId): array;

    /**
     * @param int $id
     *
     * @return ContainerAttributeInterface[]
     * @throws EmptyResultException
     */
    public function getAttributesByResourceId(int $id): array;

    /**
     * @param int $id
     * @param int $attributeId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAttribute(int $id, int $attributeId): bool;

    /**
     * @param int $id
     * @param int $attributeGroupId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAttributeGroup(int $id, int $attributeGroupId): bool;

    /**
     * @param int $id
     * @param int $attributeId
     * @param int $optionId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAttributeOption(int $id, int $attributeId, int $optionId): bool;

    /**
     * @param int $id
     * @param int $attributeId
     * @param HashMapInterface $hashMap
     *
     * @return ContainerAttributeInterface
     * @throws EmptyResultException
     */
    public function updateAttribute(int $id, int $attributeId, HashMapInterface $hashMap): ContainerAttributeInterface;
}
