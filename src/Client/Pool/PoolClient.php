<?php

namespace Scn\EvalancheSoapApiConnector\Client\Pool;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapStruct\Struct\Pool\PoolAttributeInterface;

/**
 * Class PoolClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Pool
 */
final class PoolClient extends AbstractClient implements PoolClientInterface
{
    use ResourceTrait;

    const PORTNAME = 'pool';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     * @param string $title
     * @param string $label
     * @param int $typeId
     *
     * @return PoolAttributeInterface
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
     */
    public function addAttribute(int $id, string $title, string $label, int $typeId): PoolAttributeInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->addAttribute([
                'pool_id' => $id,
                'name' => $title,
                'label' => $label,
                'type_id' => $typeId
            ]),
            'addAttributeResult',
            $this->hydratorConfigFactory->createPoolAttributeConfig()
        );
    }

    /**
     * @param int $id
     * @param int $attributeId
     * @param string[] $labels
     *
     * @return PoolAttributeInterface
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
     */
    public function addAttributeOptions(int $id, int $attributeId, array $labels): PoolAttributeInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->addAttributeOptions([
                'pool_id' => $id,
                'attribute_id' => $attributeId,
                'labels' => $labels
            ]),
            'addAttributeOptionsResult',
            $this->hydratorConfigFactory->createPoolAttributeConfig()
        );
    }

    /**
     * @param int $id
     * @param int $attributeId
     * @param int $optionId
     *
     * @return PoolAttributeInterface
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
     */
    public function deleteAttributeOption(int $id, int $attributeId, int $optionId): PoolAttributeInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->deleteAttributeOption([
                'pool_id' => $id,
                'attribute_id' => $attributeId,
                'option_id' => $optionId
            ]),
            'deleteAttributeOptionResult',
            $this->hydratorConfigFactory->createPoolAttributeConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return PoolAttributeInterface[]
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
     */
    public function getAttributesByPool(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getAttributes(['pool_id' => $id]),
            'getAttributesResult',
            $this->hydratorConfigFactory->createPoolAttributeConfig()
        );
    }

    /**
     * @param int $id
     * @param int $attributeId
     * @param int $optionId
     * @param string $label
     *
     * @return PoolAttributeInterface
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
     */
    public function updateAttributeOption(
        int $id,
        int $attributeId,
        int $optionId,
        string $label
    ): PoolAttributeInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->updateAttributeOption([
                'pool_id' => $id,
                'attribute_id' => $attributeId,
                'option_id' => $optionId,
                'label' => $label
            ]),
            'updateAttributeOptionResult',
            $this->hydratorConfigFactory->createPoolAttributeConfig()
        );
    }
}