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
     * @param int $id
     * @param string $title
     *
     * @return ContainerAttributeGroupInterface
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
     * @param int $id
     * @param int $attributeId
     * @param int $typeId
     *
     * @return bool
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
     * @param int $id
     * @param int $attributeId
     * @param string $label
     *
     * @return ContainerAttributeOptionInterface
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
     * @param int $id
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
     * @param int $id
     * @param int $attributeId
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
     * @param int $id
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
     * @param int $id
     * @param int $attributeId
     *
     * @return bool
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
     * @param int $id
     * @param int $attributeGroupId
     *
     * @return bool
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
     * @param int $id
     * @param int $attributeId
     * @param int $optionId
     *
     * @return bool
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
     * @param int $id
     * @param int $attributeId
     * @param HashMapInterface $hashMap
     *
     * @return ContainerAttributeInterface
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
