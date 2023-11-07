<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingArticleInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotItemInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\AllowedTemplatesInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateAllowedTemplatesInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplatesSourcesInterface;

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
     * @param string $title
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(
        string $title,
        int $folderId
    ): ResourceInformationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->create(
                [
                    'name' => $title,
                    'category_id' => $folderId,
                ]
            ),
            'createResult',
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

    /**
     * @param int $id
     *
     * @return MailingTemplatesSourcesInterface
     * @throws EmptyResultException
     */
    public function getSources(int $id): MailingTemplatesSourcesInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getSources(
                [
                    'mailing_template_id' => $id,
                ]
            ),
            'getSourcesResult',
            $this->hydratorConfigFactory->createMailingTemplateSourcesConfig()
        );
    }

    /**
     * @param int $id
     * @param MailingTemplatesSourcesInterface $configuration
     *
     * @return MailingTemplatesSourcesInterface
     * @throws EmptyResultException
     */
    public function setSources(
        int $id,
        MailingTemplatesSourcesInterface $configuration,
        bool $overwrite = false
    ): MailingTemplatesSourcesInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->setSources(
                [
                    'mailing_template_id' => $id,
                    'sources' => $this->extractor->extract(
                        $this->hydratorConfigFactory->createMailingTemplateSourcesConfig(),
                        $configuration
                    ),
                    'overwrite' => $overwrite
                ]
            ),
            'setSourcesResult',
            $this->hydratorConfigFactory->createMailingTemplateSourcesConfig()
        );
    }

    /**
     * Removes an existing slot from a mailing template
     *
     * @param int $id
     * @param int $slotId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeSlot(int $id, int $slotId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeSlot([
                'mailing_template_id' => $id,
                'slot_id' => $slotId
            ]),
            'removeSlotResult'
        );
    }

    /**
     * Removes an article template configuration for a certain template type from an existing slot
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
    ): bool {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeTemplateFromSlot([
                'mailing_template_id' => $id,
                'slot_id' => $slotId,
                'template_type' => $templateType,
                'article_type_id' => $articleTypeId
            ]),
            'removeTemplateFromSlotResult'
        );
    }

    /**
     * @param int $id
     *
     * @return MailingSlotConfigurationInterface
     * @throws EmptyResultException
     */
    public function getSlotConfiguration(int $id): MailingSlotConfigurationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getSlotConfiguration(['mailing_template_id' => $id]),
            'getSlotConfigurationResult',
            $this->hydratorConfigFactory->createMailingSlotConfigurationConfig()
        );
    }

    /**
     * Adds a slot to the mailing template
     *
     * @param int $id
     * @param int $slotNumber
     *
     * @return MailingSlotInterface
     * @throws EmptyResultException
     */
    public function addSlot(
        int $id,
        int $slotNumber
    ): MailingSlotInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->addSlot([
                'mailing_template_id' => $id,
                'slot_number' => $slotNumber,
            ]),
            'addSlotResult',
            $this->hydratorConfigFactory->createMailingSlotConfig()
        );
    }

    /**
     * Update a slot of the mailing template
     *
     * @param int $id
     * @param int $slotId
     * @param int $slotNumber
     * @param string $name
     * @param int $sortTypeId
     * @param int $sortValue
     *
     * @return MailingSlotInterface
     * @throws EmptyResultException
     */
    public function updateSlot(
        int $id,
        int $slotId,
        int $slotNumber,
        string $name,
        int $sortTypeId,
        int $sortValue
    ): MailingSlotInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->updateSlot([
                'mailing_template_id' => $id,
                'slot_id' => $slotId,
                'slot_number' => $slotNumber,
                'name' => $name,
                'sort_type_id' => $sortTypeId,
                'sort_value' => $sortValue
            ]),
            'updateSlotResult',
            $this->hydratorConfigFactory->createMailingSlotConfig()
        );
    }

    /**
     * Adds a template config to an existing slot
     *
     * @param int $id
     * @param int $slotId
     * @param HashMapInterface $config
     * @param int $articleTypeId
     * @param MailingTemplateAllowedTemplatesInterface[] $allowed_templates
     *
     * @return MailingSlotItemInterface
     * @throws EmptyResultException
     */
    public function addTemplatesToSlot(
        int $id,
        int $slotId,
        HashMapInterface $config,
        int $articleTypeId = 0,
        array $allowed_templates = []
    ): MailingSlotItemInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->addTemplatesToSlot([
                'mailing_template_id' => $id,
                'slot_id' => $slotId,
                'data' => $config,
                'article_type_id' => $articleTypeId,
                'allowed_templates' => $this->extractor->extractArray(
                    $this->hydratorConfigFactory->createMailingTemplateAllowedTemplatesConfig(),
                    $allowed_templates
                )
            ]),
            'addTemplatesToSlotResult',
            $this->hydratorConfigFactory->createMailingSlotItemConfig()
        );
    }

    /**
     * Updates an existing template config of a slot
     *
     * @param int $id
     * @param int $slotId
     * @param HashMapInterface $config
     * @param int $articleTypeId
     * @param MailingTemplateAllowedTemplatesInterface[] $allowed_templates
     *
     * @return MailingSlotItemInterface
     * @throws EmptyResultException
     */
    public function updateSlotTemplates(
        int $id,
        int $slotId,
        HashMapInterface $config,
        int $articleTypeId = 0,
        array $allowed_templates = []
    ): MailingSlotItemInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->updateSlotTemplates([
                'mailing_template_id' => $id,
                'slot_id' => $slotId,
                'data' => $config,
                'article_type_id' => $articleTypeId,
                'allowed_templates' => $this->extractor->extractArray(
                    $this->hydratorConfigFactory->createMailingTemplateAllowedTemplatesConfig(),
                    $allowed_templates
                )
            ]),
            'updateSlotTemplatesResult',
            $this->hydratorConfigFactory->createMailingSlotItemConfig()
        );
    }
}
