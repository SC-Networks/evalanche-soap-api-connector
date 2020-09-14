<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingArticleInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateConfigurationInterface;

/**
 * Interface MailingTemplateClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mailing
 */
interface MailingTemplateClientInterface extends ClientInterface, ResourceTraitInterface
{

    /**
     * @param string $title
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
     */
    public function create(
        string $title,
        int $folderId
    ): ResourceInformationInterface;
    
    /**
     * @param int $id
     * @param string $title
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function updateTitle(int $id, string $title): ResourceInformationInterface;


    /**
     * @param int $id
     * @param array $articles
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function addArticles(int $id, array $articles): array;

    /**
     * @param int $id
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAllArticles(int $id): bool;

    /**
     * @param int $id
     * @param int[] $referenceIds
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function removeArticles(int $id, array $referenceIds): array;

    /**
     * @param int $id
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function getArticlesByMailingTemplateId(int $id): array;

    /**
     * Applies an mailing template to existing mailing objects
     * 
     * @param int $id
     * @param int[] $mailingIds
     * 
     * @return bool
     */
    public function applyTemplate(int $id, array $mailingIds): bool;

    /**
     * Retrieve the configuration of a mailing template
     * 
     * @param int $id
     *
     * @return MailingTemplateConfigurationInterface
     */
    public function getConfiguration(int $id): MailingTemplateConfigurationInterface;

    /**
     * Sets the configuration of a mailing template
     * 
     * @param int $id
     * @param MailingTemplateConfigurationInterface $configuration
     *
     * @return MailingTemplateConfigurationInterface
     */
    public function setConfiguration(
        int $id,
        MailingTemplateConfigurationInterface $configuration
    ): MailingTemplateConfigurationInterface;
}
