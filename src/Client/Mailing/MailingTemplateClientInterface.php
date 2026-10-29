<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingArticleInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotItemInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateAllowedTemplatesInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplatesSourcesInterface;

/**
 * Interface MailingTemplateClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mailing
 */
interface MailingTemplateClientInterface extends ClientInterface, ResourceTraitInterface
{
    /**
     *
     * @throws EmptyResultException
     */
    public function create(
        string $title,
        int $folderId
    ): ResourceInformationInterface;


    /**
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function addArticles(int $id, array $articles): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function removeAllArticles(int $id): bool;

    /**
     * @param int[] $referenceIds
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function removeArticles(int $id, array $referenceIds): array;

    /**
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function getArticlesByMailingTemplateId(int $id): array;

    /**
     * Applies an mailing template to existing mailing objects
     *
     * @param int[] $mailingIds
     */
    public function applyTemplate(int $id, array $mailingIds): bool;

    /**
     * Retrieve the configuration of a mailing template
     */
    public function getConfiguration(int $id): MailingTemplateConfigurationInterface;

    /**
     * Sets the configuration of a mailing template
     */
    public function setConfiguration(
        int $id,
        MailingTemplateConfigurationInterface $configuration
    ): MailingTemplateConfigurationInterface;

    /**
     * Retrieves the source codes of a mailing template
     *
     *
     * @throws EmptyResultException
     */
    public function getSources(int $id): MailingTemplatesSourcesInterface;

    /**
     * Sets the source codes of a mailing template
     *
     *
     * @throws EmptyResultException
     */
    public function setSources(
        int $id,
        MailingTemplatesSourcesInterface $configuration,
        bool $overwrite = false
    ): MailingTemplatesSourcesInterface;

    /**
     * Removes an existing slot from a mailing template
     *
     *
     * @throws EmptyResultException
     */
    public function removeSlot(int $id, int $slotId): bool;

    /**
     * Removes an article template configuration for a certain template type from an existing slot
     *
     *
     * @throws EmptyResultException
     */
    public function removeTemplateFromSlot(
        int $id,
        int $slotId,
        int $templateType,
        int $articleTypeId = 0
    ): bool;

    /**
     * @throws EmptyResultException
     */
    public function getSlotConfiguration(int $id): MailingSlotConfigurationInterface;

    /**
     * Adds a slot to the mailing template
     *
     *
     * @throws EmptyResultException
     */
    public function addSlot(
        int $id,
        int $slotNumber
    ): MailingSlotInterface;

    /**
     * Update a slot of the mailing template
     *
     *
     * @throws EmptyResultException
     */
    public function updateSlot(
        int $id,
        int $slotId,
        int $slotNumber,
        string $name,
        int $sortTypeId,
        int $sortValue
    ): MailingSlotInterface;

    /**
     * Adds a template config to an existing slot
     *
     * @param MailingTemplateAllowedTemplatesInterface[] $allowed_templates
     *
     * @throws EmptyResultException
     */
    public function addTemplatesToSlot(
        int $id,
        int $slotId,
        HashMapInterface $config,
        int $articleTypeId = 0,
        array $allowed_templates = []
    ): MailingSlotItemInterface;

    /**
     * Updates an existing template config of a slot
     *
     * @param MailingTemplateAllowedTemplatesInterface[] $allowed_templates
     *
     * @throws EmptyResultException
     */
    public function updateSlotTemplates(
        int $id,
        int $slotId,
        HashMapInterface $config,
        int $articleTypeId = 0,
        array $allowed_templates = []
    ): MailingSlotItemInterface;
}
