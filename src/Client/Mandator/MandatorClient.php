<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mandator;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Mandator\MandatorInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class MandatorClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mandator
 */
final class MandatorClient extends AbstractClient implements MandatorClientInterface
{
    const PORTNAME = 'mandator';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     *
     * @return MandatorInterface|StructInterface
     * @throws EmptyResultException
     */
    public function getById(int $id): StructInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getById(['mandator_id' => $id]),
            'getByIdResult',
            $this->hydratorConfigFactory->createMandatorConfig()
        );
    }

    /**
     *
     * @return MandatorInterface[]
     * @throws EmptyResultException
     */
    public function getList(): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getList(),
            'getListResult',
            $this->hydratorConfigFactory->createMandatorConfig()
        );
    }

    /** @inheritDoc */
    public function create(
        string $name,
        bool $demo_mode,
        int $pricemodel_id = 0,
        string $description = '',
        int $industry_type = 1,
    ): StructInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->create([
                'name' => $name,
                'demo_mode' => $demo_mode,
                'pricemodel_id' => $pricemodel_id,
                'description' => $description,
                'industry_type' => $industry_type,
            ]),
            'createResult',
            $this->hydratorConfigFactory->createMandatorConfig()
        );
    }

    /** @inheritDoc */
    public function importScenario(
        int $mandator_id,
        string $scenario_data,
        string $language_code
    ): bool {
        return $this->responseMapper->getBoolean(
            $this->soapClient->importScenario([
                'mandator_id' => $mandator_id,
                'scenario_data' => $scenario_data,
                'language_code' => $language_code,
            ]),
            'importScenarioResult',
        );
    }
}
