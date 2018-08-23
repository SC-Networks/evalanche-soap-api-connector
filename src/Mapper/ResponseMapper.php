<?php

namespace Scn\EvalancheSoapApiConnector\Mapper;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\Hydrator\HydratorInterface;

/**
 * Class ResponseMapper
 *
 * @package Scn\EvalancheSoapApiConnector\Mapper
 */
final class ResponseMapper implements ResponseMapperInterface
{
    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @param HydratorInterface $hydrator
     */
    public function __construct(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

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
    ): int {
        if (isset($response->$responseProperty)) {
            return (int)$response->$responseProperty;
        }

        throw new EmptyResultException('Empty Result');
    }

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
    ): bool {
        if (isset($response->$responseProperty)) {
            return (bool)$response->$responseProperty;
        }

        throw new EmptyResultException('Empty Result');
    }

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
    ): string {
        if (isset($response->$responseProperty)) {
            return (string)$response->$responseProperty;
        }

        throw new EmptyResultException('Empty Result');
    }

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
    ): array {
        if (isset($response->$responseProperty)) {
            return (array)$response->$responseProperty;
        }

        throw new EmptyResultException('Empty Result');
    }

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
    ): StructInterface {

        if (isset($response->$responseProperty)) {
            return $this->mapSingleObject($response->$responseProperty, $hydratorConfig);
        }

        throw new EmptyResultException('Empty Result');
    }

    /**
     * @param object $response
     * @param HydratorConfigInterface $hydratorConfig
     *
     * @return StructInterface
     */
    public function getObjectDirectly(object $response, HydratorConfigInterface $hydratorConfig)
    {
        return $this->mapSingleObject($response, $hydratorConfig);
    }

    /**
     * @param object $objectResponse
     * @param HydratorConfigInterface $hydratorConfig
     *
     * @return StructInterface
     */
    private function mapSingleObject(object $objectResponse, HydratorConfigInterface $hydratorConfig): StructInterface
    {
        $object = $hydratorConfig->getObject();

        $this->hydrator->hydrate(
            $hydratorConfig,
            $object,
            (array)$objectResponse
        );

        return $object;
    }

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
    ): array {
        if (isset($response->$responseProperty)) {
            return $this->mapListOfObjects($this->getListFromResponse($response->$responseProperty), $hydratorConfig);
        }

        throw new EmptyResultException('Empty Result');
    }

    /**
     * @param array $objectResponse
     * @param HydratorConfigInterface $hydratorConfig
     *
     * @return array
     */
    private function mapListOfObjects(array $objectResponse, HydratorConfigInterface $hydratorConfig): array
    {
        foreach ($objectResponse as $objectKey => $unmappedObject) {
            $objectResponse[$objectKey] = $this->mapSingleObject($unmappedObject, $hydratorConfig);
        }

        return $objectResponse;
    }

    /**
     * @param object $objectResponse
     *
     * @return array
     */
    private function getListFromResponse(object $objectResponse): array
    {
        if (property_exists($objectResponse, 'items') || !property_exists($objectResponse, 'item')) {
            return [];
        }

        $items = $objectResponse->item;

        if (!is_array($items)) {
            $items = [$items];
        }

        return $items;
    }
}