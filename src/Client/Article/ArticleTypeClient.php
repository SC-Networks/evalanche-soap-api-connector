<?php

namespace Scn\EvalancheSoapApiConnector\Client\Article;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTrait;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeGroupInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeOptionInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeRoleTypeInterface;

/**
 * Class ArticleTypeClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Article
 */
final class ArticleTypeClient extends AbstractClient implements ArticleTypeClientInterface
{
    use ResourceTrait;
    use CreateResourceTrait;

    const PORTNAME = 'articletype';
    const VERSION = ClientInterface::VERSION_V0;

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
    ): ContainerAttributeInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->addAttribute(
                [
                    'resource_id' => $id,
                    'name' => $title,
                    'label' => $label,
                    'type_id' => $typeId,
                    'group_id' => $groupId
                ]
            ),
            'addAttributeResult',
            $this->hydratorConfigFactory->createContainerAttributeConfig()
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function addAttributeGroup(int $id, string $title): ContainerAttributeGroupInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->addAttributeGroup(
                ['resource_id' => $id, 'name' => $title]
            ),
            'addAttributeGroupResult',
            $this->hydratorConfigFactory->createContainerAttributeGroupConfig()
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function assignRoleToAttribute(int $id, int $attributeId, int $roleTypeId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->assignRoleToAttribute(
                ['resource_id' => $id, 'attribute_id' => $attributeId, 'role_type_id' => $roleTypeId]
            ),
            'assignRoleToAttributeResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function changeAttributeType(int $id, int $attributeId, int $typeId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->changeAttributeType(
                ['resource_id' => $id, 'attribute_id' => $attributeId, 'type_id' => $typeId]
            ),
            'changeAttributeTypeResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function createAttributeOption(int $id, int $attributeId, string $label): ContainerAttributeOptionInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->createAttributeOption(
                ['resource_id' => $id, 'attribute_id' => $attributeId, 'label' => $label]
            ),
            'createAttributeOptionResult',
            $this->hydratorConfigFactory->createContainerAttributeOptionConfig()
        );
    }

    /**
     *
     * @return ContainerAttributeRoleTypeInterface[]
     * @throws EmptyResultException
     */
    public function getApplicableRoleTypes(int $id, int $attributeId): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getApplicableRoleTypes(
                ['resource_id' => $id, 'attribute_id' => $attributeId]
            ),
            'getApplicableRoleTypesResult',
            $this->hydratorConfigFactory->createContainerAttributeRoleTypeConfig()
        );
    }

    /**
     *
     * @return ContainerAttributeRoleTypeInterface[]
     * @throws EmptyResultException
     */
    public function getAssignedRoleTypes(int $id, int $attributeId): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getAssignedRoleTypes(
                ['resource_id' => $id, 'attribute_id' => $attributeId]
            ),
            'getAssignedRoleTypesResult',
            $this->hydratorConfigFactory->createContainerAttributeRoleTypeConfig()
        );
    }

    /**
     *
     * @return ContainerAttributeGroupInterface[]
     * @throws EmptyResultException
     */
    public function getAttributeGroups(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getAttributeGroups(
                ['resource_id' => $id]
            ),
            'getAttributeGroupsResult',
            $this->hydratorConfigFactory->createContainerAttributeGroupConfig()
        );
    }

    /**
     *
     * @return ContainerAttributeOptionInterface[]
     * @throws EmptyResultException
     */
    public function getAttributeOptions(int $id, int $attributeId): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getAttributeOptions(
                ['resource_id' => $id, 'attribute_id' => $attributeId]
            ),
            'getAttributeOptionsResult',
            $this->hydratorConfigFactory->createContainerAttributeOptionConfig()
        );
    }

    /**
     *
     * @return ContainerAttributeInterface[]
     * @throws EmptyResultException
     */
    public function getAttributes(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getAttributes(
                ['resource_id' => $id]
            ),
            'getAttributesResult',
            $this->hydratorConfigFactory->createContainerAttributeConfig()
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function removeAttribute(int $id, int $attributeId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeAttribute(
                ['resource_id' => $id, 'attribute_id' => $attributeId]
            ),
            'removeAttributeResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function removeAttributeGroup(int $id, int $attributeGroupId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeAttributeGroup(
                ['resource_id' => $id, 'attribute_group_id' => $attributeGroupId]
            ),
            'removeAttributeGroupResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function removeAttributeOption(int $id, int $attributeId, int $optionId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeAttributeOption(
                ['resource_id' => $id, 'attribute_id' => $attributeId, 'option_id' => $optionId]
            ),
            'removeAttributeOptionResult'
        );
    }
}
