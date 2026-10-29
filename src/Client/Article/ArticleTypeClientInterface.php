<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Article;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeGroupInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeOptionInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeRoleTypeInterface;

/**
 * Interface ArticleTypeClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Article
 */
interface ArticleTypeClientInterface extends ClientInterface, ResourceTraitInterface
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
    public function assignRoleToAttribute(int $id, int $attributeId, int $roleTypeId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function changeAttributeType(int $id, int $attributeId, int $typeId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function createAttributeOption(int $id, int $attributeId, string $label): ContainerAttributeOptionInterface;

    /**
     *
     * @return ContainerAttributeRoleTypeInterface[]
     * @throws EmptyResultException
     */
    public function getApplicableRoleTypes(int $id, int $attributeId): array;

    /**
     *
     * @return ContainerAttributeRoleTypeInterface[]
     * @throws EmptyResultException
     */
    public function getAssignedRoleTypes(int $id, int $attributeId): array;

    /**
     *
     * @return ContainerAttributeGroupInterface[]
     * @throws EmptyResultException
     */
    public function getAttributeGroups(int $id): array;

    /**
     *
     * @return ContainerAttributeOptionInterface[]
     * @throws EmptyResultException
     */
    public function getAttributeOptions(int $id, int $attributeId): array;

    /**
     *
     * @return ContainerAttributeInterface[]
     * @throws EmptyResultException
     */
    public function getAttributes(int $id): array;

    /**
     *
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
}
