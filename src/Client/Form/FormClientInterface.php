<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Form;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Form\FormConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\FormStatisticInterface;

/**
 * Interface FormClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Form
 */
interface FormClientInterface extends ClientInterface, ResourceTraitInterface
{
    /**
     *
     * @throws EmptyResultException
     */
    public function addAttribute(int $id, int $poolAttributeId): int;

    /**
     *
     * @throws EmptyResultException
     */
    public function addAttributeOption(int $id, int $optionId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function createAlias(int $id, string $title, int $folderId): ResourceInformationInterface;

    /**
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getAliases(int $id): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function getFormByAlias(int $id): ResourceInformationInterface;

    /**
     *
     * @return FormStatisticInterface[]
     * @throws EmptyResultException
     */
    public function getStatistics(int $id, bool $includeAliases): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function removeAttribute(int $id, int $formAttributeId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function removeAttributeOption(int $id, int $optionId): bool;

    /**
     *
     * @throws EmptyResultException
     */
    public function updateTemplate(int $id, string $templateHtml): ResourceInformationInterface;

    public function create(int $poolId, string $title): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $id,
        FormConfigurationInterface $configuration
    ): FormConfigurationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): FormConfigurationInterface;

    /**
     * Toggles the individual html-template mode
     *
     * @return bool The current state of the individual html-temlate mode
     *
     * @throws EmptyResultException
     */
    public function toggleHtmlTemplateMode(int $id, bool $enabled): bool;
}
