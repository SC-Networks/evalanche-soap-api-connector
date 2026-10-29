<?php

namespace Scn\EvalancheSoapApiConnector\Client\Pool;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
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
     *
     * @throws EmptyResultException
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
     * @param string[] $labels
     *
     * @throws EmptyResultException
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
     * @throws EmptyResultException
     */
    public function deleteAttribute(int $id, int $attributeId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->deleteAttribute([
                'pool_id' => $id,
                'attribute_id' => $attributeId
            ]),
            'deleteAttributeResult'
        );
    }

    /**
     *
     * @throws EmptyResultException
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
     *
     * @return PoolAttributeInterface[]
     * @throws EmptyResultException
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
     *
     * @throws EmptyResultException
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
