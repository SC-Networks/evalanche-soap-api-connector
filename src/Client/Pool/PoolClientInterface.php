<?php

declare(strict_types=1);

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
     *
     * @throws EmptyResultException
     */
    public function addAttribute(int $id, string $title, string $label, int $typeId): PoolAttributeInterface;

    /**
     * @param string[] $labels
     *
     * @throws EmptyResultException
     */
    public function addAttributeOptions(int $id, int $attributeId, array $labels): PoolAttributeInterface;

    /**
     * @throws EmptyResultException
     */
    public function deleteAttribute(int $id, int $attributeId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function deleteAttributeOption(int $id, int $attributeId, int $optionId): PoolAttributeInterface;

    /**
     *
     * @return PoolAttributeInterface[]
     * @throws EmptyResultException
     */
    public function getAttributesByPool(int $id): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function updateAttributeOption(
        int $id,
        int $attributeId,
        int $optionId,
        string $label
    ): PoolAttributeInterface;
}
