<?php

namespace Scn\EvalancheSoapApiConnector\Client\Workflow;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTrait;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowConfigVersionInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowDetailInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowStateChangeResultInterface;

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
            $this->soapClient->getByEndDateRange([
                'from' => $timestampStart,
                'to' => $timestampEnd
            ]),
            'getByEndDateRangeResult',
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
     * @param string $name
     * @param int $schemaVersion
     * @param string $workflowConfiguration
     * @param int $categoryId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function createConfigured(string $name, int $schemaVersion, string $workflowConfiguration, int $categoryId = 0): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->createConfigured([
                'name' => $name,
                'schema_version' => $schemaVersion,
                'configuration' => $workflowConfiguration,
                'category_id' => $categoryId
            ]),
            'createConfiguredResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * Export a specific workflow configuration as JSON string
     *
     * @param int $workflowId
     *
     * @return string
     * @throws EmptyResultException
     */
    public function export(int $workflowId): string
    {
        return $this->responseMapper->getString(
            $this->soapClient->export([
                'workflow_id' => $workflowId
            ]),
            'exportResult'
        );
    }

    /**
     * Update the configuration of a campaign and returns the new config version id
     *
     * @param int $workflowId
     * @param string $configVersion The campaign config version
     * @param string $configuration The configuration as json encoded string
     *
     * @return string The new config version id
     *
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $workflowId,
        string $configVersion,
        string $configuration
    ): string {
        return $this->responseMapper->getString(
            $this->soapClient->setConfiguration([
                'workflow_id' => $workflowId,
                'config_version' => $configVersion,
                'configuration' => $configuration,
            ]),
            'setConfigurationResult'
        );
    }

    /**
     * Return the configuration of a campaign
     *
     * @param int $workflowId
     *
     * @return WorkflowConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $workflowId): WorkflowConfigurationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getConfiguration(['workflow_id' => $workflowId]),
            'getConfigurationResult',
            $this->hydratorConfigFactory->createWorkflowConfigurationConfig()
        );
    }

    /**
     * Gets the config versions of a campaign
     *
     * @param int $workflowId
     *
     * @return WorkflowConfigVersionInterface[]
     * @throws EmptyResultException
     */
    public function getConfigurationVersions(int $workflowId): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getConfigurationVersions([
                'workflow_id' => $workflowId
            ]),
            'getConfigurationVersionsResult',
            $this->hydratorConfigFactory->createWorkflowConfigVersionConfig()
        );
    }

    /**
     * Activates a campaign
     *
     * @param int $workflowId
     *
     * @return WorkflowStateChangeResultInterface
     * @throws EmptyResultException
     */
    public function activate(int $workflowId): WorkflowStateChangeResultInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->activate(['workflow_id' => $workflowId]),
            'activateResult',
            $this->hydratorConfigFactory->createWorkflowStateChangeResultConfig()
        );
    }

    /**
     * Deactivates a campaign
     *
     * @param int $workflowId
     *
     * @return WorkflowStateChangeResultInterface
     * @throws EmptyResultException
     */
    public function deactivate(int $workflowId): WorkflowStateChangeResultInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->deactivate(['workflow_id' => $workflowId]),
            'deactivateResult',
            $this->hydratorConfigFactory->createWorkflowStateChangeResultConfig()
        );
    }
}
