<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingArticleInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateConfigurationInterface;

/**
 * Class MailingTemplateClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mailing
 */
class MailingTemplateClient extends AbstractClient implements MailingTemplateClientInterface
{
    use ResourceTrait;

    const PORTNAME = 'mailingtemplate';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     * @param string $title
     *
     * @return ResourceInformationInterface
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
     */
    public function updateTitle(int $id, string $title): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->rename(['resource_id' => $id, 'name' => $title]),
            'renameResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param array $articles
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function addArticles(int $id, array $articles): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->addArticles(
                [
                    'mailing_template_id' => $id,
                    'articles' => $this->extractor->extractArray(
                        $this->hydratorConfigFactory->createMailingArticleConfig(),
                        $articles
                    )
                ]
            ),
            'addArticlesResult',
            $this->hydratorConfigFactory->createMailingArticleConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAllArticles(int $id): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeAllArticles([
                'mailing_template_id' => $id
            ]),
            'removeAllArticlesResult'
        );
    }

    /**
     * @param int $id
     * @param int[] $referenceIds
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function removeArticles(int $id, array $referenceIds): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->removeArticles(
                [
                    'mailing_template_id' => $id,
                    'reference_ids' => $referenceIds,
                ]
            ),
            'removeArticlesResult',
            $this->hydratorConfigFactory->createMailingArticleConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return MailingArticleInterface[]
     * @throws EmptyResultException
     */
    public function getArticlesByMailingTemplateId(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getArticles([
                'mailing_template_id' => $id
            ]),
            'getArticlesResult',
            $this->hydratorConfigFactory->createMailingArticleConfig()
        );
    }

    /**
     * @param int $id
     * @param array $mailingIds
     * 
     * @return bool
     * 
     * @throws EmptyResultException
     */
    public function applyTemplate(int $id, array $mailingIds): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->applyTemplate(
                [
                    'mailing_template_id' => $id,
                    'mailing_ids' => $mailingIds,
                ]
            ),
            'applyTemplateResult'
        );
    }

    /**
     * @param int $id
     *
     * @return MailingTemplateConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): MailingTemplateConfigurationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getConfiguration(
                [
                    'mailing_template_id' => $id,
                ]
            ),
            'getConfigurationResult',
            $this->hydratorConfigFactory->createMailingTemplateConfigurationConfig()
        );
    }

    /**
     * @param int $id
     * @param MailingTemplateConfigurationInterface $configuration
     *
     * @return MailingTemplateConfigurationInterface
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $id,
        MailingTemplateConfigurationInterface $configuration
    ): MailingTemplateConfigurationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->setConfiguration(
                [
                    'mailing_template_id' => $id,
                    'configuration' => $this->extractor->extract(
                        $this->hydratorConfigFactory->createMailingTemplateConfigurationConfig(),
                        $configuration
                    ),
                ]
            ),
            'setConfigurationResult',
            $this->hydratorConfigFactory->createMailingTemplateConfigurationConfig()
        );
    }
}
