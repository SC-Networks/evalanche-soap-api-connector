<?php

namespace Scn\EvalancheSoapApiConnector\Client\Pool;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Pool\PoolAttributeInterface;

/**
 * Interface PoolClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Pool
 */
interface PoolClientInterface extends ClientInterface, ResourceTraitInterface
{
    /**
     * @param int $id
     * @param string $title
     * @param string $label
     * @param int $typeId
     *
     * @return PoolAttributeInterface
     * @throws EmptyResultException
     */
    public function addAttribute(int $id, string $title, string $label, int $typeId): PoolAttributeInterface;

    /**
     * @param int $id
     * @param int $attributeId
     * @param string[] $labels
     *
     * @return PoolAttributeInterface
     * @throws EmptyResultException
     */
    public function addAttributeOptions(int $id, int $attributeId, array $labels): PoolAttributeInterface;

    /**
     * @param int $id
     * @param int $attributeId
     * @return bool
     * @throws EmptyResultException
     */
    public function deleteAttribute(int $id, int $attributeId): bool;

    /**
     * @param int $id
     * @param int $attributeId
     * @param int $optionId
     *
     * @return PoolAttributeInterface
     * @throws EmptyResultException
     */
    public function deleteAttributeOption(int $id, int $attributeId, int $optionId): PoolAttributeInterface;

    /**
     * @param int $id
     *
     * @return PoolAttributeInterface[]
     * @throws EmptyResultException
     */
    public function getAttributesByPool(int $id): array;

    /**
     * @param int $id
     * @param int $attributeId
     * @param int $optionId
     * @param string $label
     *
     * @return PoolAttributeInterface
     * @throws EmptyResultException
     */
    public function updateAttributeOption(
        int $id,
        int $attributeId,
        int $optionId,
        string $label
    ): PoolAttributeInterface;
}
