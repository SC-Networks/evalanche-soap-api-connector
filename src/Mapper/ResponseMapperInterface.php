<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Mapper;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Interface ResponseMapperInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Mapper
 */
interface ResponseMapperInterface
{
    /**
     *
     * @throws EmptyResultException
     */
    public function getObject(
        object $response,
        string $responseProperty,
        HydratorConfigInterface $hydratorConfig
    ): StructInterface;

    /**
     *
     * @return StructInterface
     * @throws EmptyResultException
     */
    public function getObjectDirectly(object $response, HydratorConfigInterface $hydratorConfig);

    /**
     *
     * @return StructInterface[]
     */
    public function getObjectsDirectly(object $response, HydratorConfigInterface  $hydratorConfig);

    /**
     *
     * @return StructInterface[]
     * @throws EmptyResultException
     */
    public function getObjects(
        object $response,
        string $responseProperty,
        HydratorConfigInterface $hydratorConfig
    ): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getBoolean(
        object $response,
        string $responseProperty
    ): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function getString(
        object $response,
        string $responseProperty
    ): string;

    /**
     *
     * @throws EmptyResultException
     */
    public function getArray(
        object $response,
        string $responseProperty
    ): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getInteger(
        object $response,
        string $responseProperty
    ): int;
}
