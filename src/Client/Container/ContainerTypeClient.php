<?php

namespace Scn\EvalancheSoapApiConnector\Client\Container;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTrait;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeGroupInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeInterface;
use Scn\EvalancheSoapStruct\Struct\Container\ContainerAttributeOptionInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;

/**
 * Class ContainerTypeClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Container
 */
final class ContainerTypeClient extends AbstractClient implements ContainerTypeClientInterface
{
    use ResourceTrait;
    use CreateResourceTrait;

    const PORTNAME = 'containertype';
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
    public function updateAttributeType(int $id, int $attributeId, int $typeId): bool
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
    public function addAttributeOption(int $id, int $attributeId, string $label): ContainerAttributeOptionInterface
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
     * @return ContainerAttributeGroupInterface[]
     * @throws EmptyResultException
     */
    public function getAttributeGroupsByResourceId(int $id): array
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
    public function getAttributeOptionsByResourceIdAndAttributeId(int $id, int $attributeId): array
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
    public function getAttributesByResourceId(int $id): array
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

    /**
     *
     * @throws EmptyResultException
     */
    public function updateAttribute(int $id, int $attributeId, HashMapInterface $hashMap): ContainerAttributeInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->updateAttribute(
                [
                    'resource_id' => $id,
                    'attribute_id' => $attributeId,
                    'data' => $this->extractor->extract($this->hydratorConfigFactory->createHashMapConfig(), $hashMap)
                ]
            ),
            'updateAttributeResult',
            $this->hydratorConfigFactory->createContainerAttributeConfig()
        );
    }
}
