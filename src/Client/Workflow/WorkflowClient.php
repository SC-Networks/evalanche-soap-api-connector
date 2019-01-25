<?php

namespace Scn\EvalancheSoapApiConnector\Client\Workflow;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTrait;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowDetailInterface;

/**
 * Class WorkflowClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Workflow
 */
final class WorkflowClient extends AbstractClient implements WorkflowClientInterface
{
    use ResourceTrait;
    use CreateResourceTrait;

    const PORTNAME = 'campaign';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * Get campaign's by a specific Start- Date Range
     *
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByStartDateRange(int $timestampStart, int $timestampEnd): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getByStartDateRange([
                'from' => $timestampStart,
                'to' => $timestampEnd
            ]),
            'getByStartDateRangeResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * Get campaign's by a specific End- Date Range
     *
     * @param int $timestampStart
     * @param int $timestampEnd
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByEndDateRange(int $timestampStart, int $timestampEnd): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getByEndateRange([
                'from' => $timestampStart,
                'to' => $timestampEnd
            ]),
            'getByEndateRangeResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * Return Details of a campaign
     *
     * @param int $id
     *
     * @return WorkflowDetailInterface
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): WorkflowDetailInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getDetails(['resource_id' => $id]),
            'getDetailsResult',
            $this->hydratorConfigFactory->createWorkflowDetailConfig()
        );
    }

    /**
     * Push profiles into a specific campaign
     *
     * @param int $id
     * @param array $profileIds
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function pushProfilesIntoCampaign(int $id, array $profileIds): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->pushProfilesIntoCampaign([
                'resource_id' => $id,
                'profile_id_list' => $profileIds
            ]),
            'pushProfilesIntoCampaignResult'
        );
    }

    /**
     * Create a workflow by a JSON configuration
     *
     * @param string $accountId
     * @param int $schemaVersion
     * @param string $workflowConfiguration
     *
     * @return int
     * @throws EmptyResultException
     */
    public function createConfigured(string $accountId, int $schemaVersion, string $workflowConfiguration): int
    {
        return $this->responseMapper->getInteger(
            $this->soapClient->createConfigured([
                'account_id' => $accountId,
                'schema_version' => $schemaVersion,
                'workflow_configuration' => $workflowConfiguration
            ]),
            'createResult'
        );
    }

    /**
     * Export a specific workflow configuration as JSON string
     *
     * @param string $workflowId
     *
     * @return string
     * @throws EmptyResultException
     */
    public function export(string $workflowId): string
    {
        return $this->responseMapper->getString(
            $this->soapClient->export([
                'workflow_id' => $workflowId
            ]),
            'export'
        );
    }
}
