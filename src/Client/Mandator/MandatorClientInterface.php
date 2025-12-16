<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mandator;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Mandator\MandatorInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Interface MandatorClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mandator
 */
interface MandatorClientInterface extends ClientInterface
{
    /**
     * @param int $id
     *
     * @return MandatorInterface
     */
    public function getById(int $id): StructInterface;

    /**
     *
     * @return MandatorInterface[]
     */
    public function getList(): array;

    /**
     * Creates a new mandator
     *
     * @param string $name Name of the new mandator
     * @param bool $demo_mode Set to `true` if the mandator should be a demo-mandator
     * @param int $pricemodel_id If of the designated pricemodel (will be ignored for demo-mandators)
     * @param string $description Descriptive text for the mandator
     * @param int $industry_type Industry-type the mandator should be assigned to
     */
    public function create(
        string $name,
        bool $demo_mode,
        int $pricemodel_id = 0,
        string $description = '',
        int $industry_type = 1,
    ): StructInterface;

    /**
     * Imports a new scenario
     *
     * @param int $mandator_id The id of the mandator the scenario should be imported to
     * @param string $scenario_data Base64-encoded scenario-json data
     * @param string $language_code ISO2 language code
     *
     * @throws EmptyResultException
     */
    public function importScenario(
        int $mandator_id,
        string $scenario_data,
        string $language_code
    ): bool;
}
