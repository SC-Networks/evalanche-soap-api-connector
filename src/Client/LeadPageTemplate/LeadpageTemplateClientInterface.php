<?php

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
     * @param string $title
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(
        string $title,
        int $folderId
    ): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return TemplatesSourcesInterface
     * @throws EmptyResultException
     */
    public function getSources(int $id): TemplatesSourcesInterface;

    /**
     * @param int $id
     * @param TemplatesSourcesInterface $configuration
     *
     * @return TemplatesSourcesInterface
     * @throws EmptyResultException
     */
    public function setSources(
        int $id,
        TemplatesSourcesInterface $configuration,
        bool $overwrite = false
    ): TemplatesSourcesInterface;

    /**
     * @param int $id
     *
     * @return LeadpageTemplateConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): LeadpageTemplateConfigurationInterface;

    /**
     * @param int $id
     * @param LeadpageTemplateConfigurationInterface $configuration
     *
     * @return LeadpageTemplateConfigurationInterface
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $id,
        LeadpageTemplateConfigurationInterface $configuration
    ): LeadpageTemplateConfigurationInterface;

    /**
     * Remove all articles from the leadpage-template
     *
     * @param int $id
     *
     * @return bool
     *
     * @throws EmptyResultException
     */
    public function removeAllArticles(int $id): bool;

    /**
     * Remove certain articles from the leadpage-template
     *
     * @param int $id
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
     * @param int $id
     *
     * @return LeadpageArticleInterface[]
     * @throws EmptyResultException
     */
    public function getArticlesByLeadpageTemplateId(int $id): array;

    /**
     * Add articles to a leadpage-template
     *
     * @param int $id
     * @param array $articles
     *
     * @return LeadpageArticleInterface[]
     * @throws EmptyResultException
     */
    public function addArticles(int $id, array $articles): array;

    /**
     * Removes an existing slot from a leadpage-template
     *
     * @param int $id
     * @param int $slotId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeSlot(int $id, int $slotId): bool;

    /**
     * Removes an article template configuration for a certain template type from an existing slot of the leadpage-template
     *
     * @param int $id
     * @param int $slotId
     * @param int $templateType
     * @param int $articleTypeId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeTemplateFromSlot(
        int $id,
        int $slotId,
        int $templateType,
        int $articleTypeId = 0
    ): bool;

    /**
     * @param int $id
     *
     * @return LeadpageSlotConfigurationInterface
     * @throws EmptyResultException
     */
    public function getSlotConfiguration(int $id): LeadpageSlotConfigurationInterface;

    /**
     * Adds a slot to the leadpage-template
     *
     * @param int $id
     * @param int $slotNumber
     *
     * @return LeadpageSlotInterface
     * @throws EmptyResultException
     */
    public function addSlot(
        int $id,
        int $slotNumber
    ): LeadpageSlotInterface;

    /**
     * Update a slot of the leadpage-template
     *
     * @param int $id
     * @param int $slotId
     * @param int $slotNumber
     * @param string $name
     * @param int $sortTypeId
     * @param int $sortValue
     *
     * @return LeadpageSlotInterface
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
     * @param int $id
     * @param int $slotId
     * @param HashMapInterface $config
     * @param int $articleTypeId
     * @param list<LeadpageTemplateAllowedTemplatesInterface> $allowed_templates
     *
     * @return LeadpageSlotItemInterface
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
     * @param int $id
     * @param int $slotId
     * @param HashMapInterface $config
     * @param int $articleTypeId
     * @param list<LeadpageTemplateAllowedTemplatesInterface> $allowed_templates
     *
     * @return LeadpageSlotItemInterface
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
