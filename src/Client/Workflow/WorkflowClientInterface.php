<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Workflow;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\JobStateInterface;
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
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByStartDateRange(int $timestampStart, int $timestampEnd): array;

    /**
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByEndDateRange(int $timestampStart, int $timestampEnd): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): WorkflowDetailInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function pushProfilesIntoCampaign(int $id, array $profileIds): bool;

    public function createConfigured(string $name, int $schemaVersion, string $workflowConfiguration, int $categoryId = 0): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function export(int $workflowId): string;

    /**
     * Update the configuration of a workflow
     *
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
     *
     * @throws EmptyResultException
     */
    public function getConfiguration(int $workflowId): WorkflowConfigurationInterface;

    /**
     * Gets the config versions of a campaign
     *
     *
     * @return WorkflowConfigVersionInterface[]
     * @throws EmptyResultException
     */
    public function getConfigurationVersions(int $workflowId): array;

    /**
     * Activates a campaign
     *
     *
     * @throws EmptyResultException
     */
    public function activate(int $workflowId): WorkflowStateChangeResultInterface;

    /**
     * Deactivates a campaign
     *
     *
     * @throws EmptyResultException
     */
    public function deactivate(int $workflowId): WorkflowStateChangeResultInterface;

    /**
     * Generates a campaign configuration
     *
     *
     * @throws EmptyResultException
     */
    public function generateConfiguration(
        int $workflowId,
        string $prompt,
    ): JobStateInterface;
}
