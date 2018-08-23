<?php

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
     * @param object $response
     * @param string $responseProperty
     * @param HydratorConfigInterface $hydratorConfig
     *
     * @return StructInterface
     * @throws EmptyResultException
     */
    public function getObject(
        object $response,
        string $responseProperty,
        HydratorConfigInterface $hydratorConfig
    ): StructInterface;

    /**
     * @param object $response
     * @param HydratorConfigInterface $hydratorConfig
     *
     * @return StructInterface
     * @throws EmptyResultException
     */
    public function getObjectDirectly(object $response, HydratorConfigInterface $hydratorConfig);

    /**
     * @param object $response
     * @param string $responseProperty
     * @param HydratorConfigInterface $hydratorConfig
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
     * @param object $response
     * @param string $responseProperty
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function getBoolean(
        object $response,
        string $responseProperty
    ): bool;

    /**
     * @param object $response
     * @param string $responseProperty
     *
     * @return string
     * @throws EmptyResultException
     */
    public function getString(
        object $response,
        string $responseProperty
    ): string;

    /**
     * @param object $response
     * @param string $responseProperty
     *
     * @return array
     * @throws EmptyResultException
     */
    public function getArray(
        object $response,
        string $responseProperty
    ): array;

    /**
     * @param object $response
     * @param string $responseProperty
     *
     * @return int
     * @throws EmptyResultException
     */
    public function getInteger(
        object $response,
        string $responseProperty
    ): int;
}