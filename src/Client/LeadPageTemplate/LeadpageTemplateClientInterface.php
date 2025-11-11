<?php

namespace Scn\EvalancheSoapApiConnector\Client\LeadPageTemplate;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageArticleInterface;
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
}
