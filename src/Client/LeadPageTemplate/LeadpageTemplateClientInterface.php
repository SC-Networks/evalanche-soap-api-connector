<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\LeadPageTemplate;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageArticleInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotItemInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\LeadpageTemplateAllowedTemplatesInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\LeadpageTemplateConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\TemplatesSourcesInterface;

interface LeadpageTemplateClientInterface extends ResourceTraitInterface, ClientInterface
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
     * @throws EmptyResultException
     */
    public function getSources(int $id): TemplatesSourcesInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function setSources(
        int $id,
        TemplatesSourcesInterface $configuration,
        bool $overwrite = false
    ): TemplatesSourcesInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): LeadpageTemplateConfigurationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $id,
        LeadpageTemplateConfigurationInterface $configuration
    ): LeadpageTemplateConfigurationInterface;

    /**
     * Remove all articles from the leadpage-template
     *
     *
     *
     * @throws EmptyResultException
     */
    public function removeAllArticles(int $id): bool;

    /**
     * Remove certain articles from the leadpage-template
     *
     * @param int[] $referenceIds
     *
     * @return LeadpageArticleInterface[]
     *
     * @throws EmptyResultException
     */
    public function removeArticles(int $id, array $referenceIds): array;

    /**
     * Retrieve all articles of the leadpage-template
     *
     *
     * @return LeadpageArticleInterface[]
     * @throws EmptyResultException
     */
    public function getArticlesByLeadpageTemplateId(int $id): array;

    /**
     * Add articles to a leadpage-template
     *
     *
     * @return LeadpageArticleInterface[]
     * @throws EmptyResultException
     */
    public function addArticles(int $id, array $articles): array;

    /**
     * Removes an existing slot from a leadpage-template
     *
     *
     * @throws EmptyResultException
     */
    public function removeSlot(int $id, int $slotId): bool;

    /**
     * Removes an article template configuration for a certain template type from an existing slot of the leadpage-template
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
     *
     * @throws EmptyResultException
     */
    public function getSlotConfiguration(int $id): LeadpageSlotConfigurationInterface;

    /**
     * Adds a slot to the leadpage-template
     *
     *
     * @throws EmptyResultException
     */
    public function addSlot(
        int $id,
        int $slotNumber
    ): LeadpageSlotInterface;

    /**
     * Update a slot of the leadpage-template
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
    ): LeadpageSlotInterface;

    /**
     * Adds a template config to an existing slot of the leadpage-template
     *
     * @param list<LeadpageTemplateAllowedTemplatesInterface> $allowed_templates
     *
     * @throws EmptyResultException
     */
    public function addTemplatesToSlot(
        int $id,
        int $slotId,
        HashMapInterface $config,
        int $articleTypeId = 0,
        array $allowed_templates = []
    ): LeadpageSlotItemInterface;

    /**
     * Updates an existing template config of a slot of the leadpage-template
     *
     * @param list<LeadpageTemplateAllowedTemplatesInterface> $allowed_templates
     *
     * @throws EmptyResultException
     */
    public function updateSlotTemplates(
        int $id,
        int $slotId,
        HashMapInterface $config,
        int $articleTypeId = 0,
        array $allowed_templates = []
    ): LeadpageSlotItemInterface;
}
