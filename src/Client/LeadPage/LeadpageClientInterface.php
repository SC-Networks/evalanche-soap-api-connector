<?php

namespace Scn\EvalancheSoapApiConnector\Client\LeadPage;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ContentGenerationInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\EditorModulesTypesTraitInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageArticleInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageConfigurationInterface;

interface LeadpageClientInterface extends
    ContentGenerationInterface,
    ResourceTraitInterface,
    EditorModulesTypesTraitInterface,
    ClientInterface
{
    /**
     * @param int $id
     * @param int $mandatorId
     *
     * @return ResourceInformationInterface[]
     */
    public function getByTypeId(int $id, int $mandatorId): array;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return LeadpageConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): LeadpageConfigurationInterface;

    /**
     * @param int $id
     * @param LeadpageConfigurationInterface $configuration
     *
     * @return LeadpageConfigurationInterface
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $id,
        LeadpageConfigurationInterface $configuration
    ): LeadpageConfigurationInterface;

    /**
     * @param int $leadpageId
     *
     * @return HashMapInterface
     * @throws EmptyResultException
     */
    public function getContentContainerData(int $leadpageId): HashMapInterface;

    /**
     * @param int $leadpageId
     * @param HashMapInterface $hashMap
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function setContentContainerData(int $leadpageId, HashMapInterface $hashMap): ResourceInformationInterface;

    /**
     * Remove all articles from the leadpage
     *
     * @param int $id
     *
     * @return bool
     *
     * @throws EmptyResultException
     */
    public function removeAllArticles(int $id): bool;

    /**
     * Remove certain articles from the leadpage
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
     * Retrieve all articles of the leadpage
     *
     * @param int $id
     *
     * @return LeadpageArticleInterface[]
     * @throws EmptyResultException
     */
    public function getArticlesByLeadpageId(int $id): array;

    /**
     * Add articles to a leadpage
     *
     * @param int $id
     * @param array $articles
     *
     * @return LeadpageArticleInterface[]
     * @throws EmptyResultException
     */
    public function addArticles(int $id, array $articles): array;
}
