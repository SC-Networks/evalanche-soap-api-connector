<?php

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
     * @param int $id
     * @param int $poolAttributeId
     *
     * @return int
     * @throws EmptyResultException
     */
    public function addAttribute(int $id, int $poolAttributeId): int;

    /**
     * @param int $id
     * @param int $optionId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function addAttributeOption(int $id, int $optionId): bool;

    /**
     * @param int $id
     * @param string $title
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function createAlias(int $id, string $title, int $folderId): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getAliases(int $id): array;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getFormByAlias(int $id): ResourceInformationInterface;

    /**
     * @param int $id
     * @param bool $includeAliases
     *
     * @return FormStatisticInterface[]
     * @throws EmptyResultException
     */
    public function getStatistics(int $id, bool $includeAliases): array;

    /**
     * @param int $id
     * @param int $formAttributeId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAttribute(int $id, int $formAttributeId): bool;

    /**
     * @param int $id
     * @param int $optionId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAttributeOption(int $id, int $optionId): bool;

    /**
     * @param int $id
     * @param string $templateHtml
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function updateTemplate(int $id, string $templateHtml): ResourceInformationInterface;

    public function create(int $poolId, string $title): ResourceInformationInterface;

    /**
     * @param int $id
     * @param FormConfigurationInterface $configuration
     *
     * @return FormConfigurationInterface
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $id,
        FormConfigurationInterface $configuration
    ): FormConfigurationInterface;

    /**
     * @param int $id
     *
     * @return FormConfigurationInterface
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
