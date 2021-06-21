<?php

namespace Scn\EvalancheSoapApiConnector\Client\Workflow;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowConfigVersionInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowDetailInterface;
use Scn\EvalancheSoapStruct\Struct\Workflow\WorkflowStateChangeResultInterface;

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
     * @param string $name
     * @param int $schemaVersion
     * @param string $workflowConfiguration
     * @param int $categoryId
     *
     * @return ResourceInformationInterface
     */
    public function createConfigured(string $name, int $schemaVersion, string $workflowConfiguration, int $categoryId = 0): ResourceInformationInterface;

    /**
     * @param int $workflowId
     *
     * @return string
     * @throws EmptyResultException
     */
    public function export(int $workflowId): string;

    /**
     * Update the configuration of a workflow
     *
     * @param int $workflowId
     * @param string $configVersion The workflow config version
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
    ): string;

    /**
     * Return the configuration of a campaign
     *
     * @param int $workflowId
     *
     * @return WorkflowConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $workflowId): WorkflowConfigurationInterface;

    /**
     * Gets the config versions of a campaign
     *
     * @param int $workflowId
     *
     * @return WorkflowConfigVersionInterface[]
     * @throws EmptyResultException
     */
    public function getConfigurationVersions(int $workflowId): array;

    /**
     * Activates a campaign
     *
     * @param int $workflowId
     *
     * @return WorkflowStateChangeResultInterface
     * @throws EmptyResultException
     */
    public function activate(int $workflowId): WorkflowStateChangeResultInterface;

    /**
     * Deactivates a campaign
     *
     * @param int $workflowId
     *
     * @return WorkflowStateChangeResultInterface
     * @throws EmptyResultException
     */
    public function deactivate(int $workflowId): WorkflowStateChangeResultInterface;
}
