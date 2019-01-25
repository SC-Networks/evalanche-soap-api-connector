<?php

namespace Scn\EvalancheSoapApiConnector\Client\Workflow;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowDetailInterface;

/**
 * Interface WorkflowClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Workflow
 */
interface WorkflowClientInterface extends ClientInterface, ResourceTraitInterface, CreateResourceTraitInterface
{

    /**
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByStartDateRange(int $timestampStart, int $timestampEnd): array;

    /**
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByEndDateRange(int $timestampStart, int $timestampEnd): array;

    /**
     * @param int $id
     *
     * @return WorkflowDetailInterface
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): WorkflowDetailInterface;

    /**
     * @param int $id
     * @param array $profileIds
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function pushProfilesIntoCampaign(int $id, array $profileIds): bool;

    /**
     * @param string $accountId
     * @param int $schemaVersion
     * @param string $workflowConfiguration
     *
     * @return int
     * @throws EmptyResultException
     */
    public function createConfigured(string $accountId, int $schemaVersion, string $workflowConfiguration): int;

    /**
     * @param string $workflowId
     *
     * @return string
     * @throws EmptyResultException
     */
    public function export(string $workflowId): string;

}
