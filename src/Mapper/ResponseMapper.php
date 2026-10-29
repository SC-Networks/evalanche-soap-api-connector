<?php

namespace Scn\EvalancheSoapApiConnector\Mapper;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\Hydrator\Hydrator;
use Scn\Hydrator\HydratorInterface;

final readonly class ResponseMapper implements ResponseMapperInterface
{
    public function __construct(private HydratorInterface $hydrator)
    {
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function getInteger(
        object $response,
        string $responseProperty
    ): int {
        if (property_exists($response, $responseProperty)) {
            return (int)$response->$responseProperty;
        }

        throw new EmptyResultException('Empty Result');
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function getBoolean(
        object $response,
        string $responseProperty
    ): bool {
        if (property_exists($response, $responseProperty)) {
            return (bool)$response->$responseProperty;
        }

        throw new EmptyResultException('Empty Result');
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function getString(
        object $response,
        string $responseProperty
    ): string {
        if (property_exists($response, $responseProperty)) {
            return (string)$response->$responseProperty;
        }

        throw new EmptyResultException('Empty Result');
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function getArray(
        object $response,
        string $responseProperty
    ): array {
        if (property_exists($response, $responseProperty)) {
            return (array)$response->$responseProperty;
        }

        throw new EmptyResultException('Empty Result');
    }

    /**
     *
     * @throws EmptyResultException
     */
    public function getObject(
        object $response,
        string $responseProperty,
        HydratorConfigInterface $hydratorConfig
    ): StructInterface {
        if (property_exists($response, $responseProperty)) {
            return $this->mapSingleObject($response->$responseProperty, $hydratorConfig);
        }

        throw new EmptyResultException('Empty Result');
    }

    /**
     *
     * @return StructInterface
     */
    public function getObjectDirectly(object $response, HydratorConfigInterface $hydratorConfig)
    {
        return $this->mapSingleObject($response, $hydratorConfig);
    }

    /**
     *
     * @return StructInterface[]
     */
    public function getObjectsDirectly(object $response, HydratorConfigInterface  $hydratorConfig)
    {
        return $this->mapListOfObjects($this->getListFromResponse($response), $hydratorConfig);
    }

    private function mapSingleObject(object $objectResponse, HydratorConfigInterface $hydratorConfig): StructInterface
    {
        $object = $hydratorConfig->getObject();

        $this->hydrator->hydrate(
            $hydratorConfig,
            $object,
            (array)$objectResponse,
            Hydrator::NO_STRICT_KEYS
        );

        return $object;
    }

    /**
     *
     * @return StructInterface[]
     * @throws EmptyResultException
     */
    public function getObjects(
        object $response,
        string $responseProperty,
        HydratorConfigInterface $hydratorConfig
    ): array {
        if (property_exists($response, $responseProperty)) {
            return $this->mapListOfObjects($this->getListFromResponse($response->$responseProperty), $hydratorConfig);
        }

        throw new EmptyResultException('Empty Result');
    }

    private function mapListOfObjects(array $objectResponse, HydratorConfigInterface $hydratorConfig): array
    {
        foreach ($objectResponse as $objectKey => $unmappedObject) {
            $objectResponse[$objectKey] = $this->mapSingleObject($unmappedObject, $hydratorConfig);
        }

        return $objectResponse;
    }

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
