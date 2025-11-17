<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\LeadPageTemplate;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotItemInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\LeadpageTemplateConfiguration;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\LeadpageTemplateConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\TemplatesSourcesInterface;

class LeadpageTemplateClient extends AbstractClient implements LeadpageTemplateClientInterface
{
    use ResourceTrait;
    const PORTNAME = 'leadpagetemplate';
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
     *
     * @return TemplatesSourcesInterface
     * @throws EmptyResultException
     */
    public function getSources(int $id): TemplatesSourcesInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getSources(
                [
                    'leadpage_template_id' => $id,
                ]
            ),
            'getSourcesResult',
            $this->hydratorConfigFactory->createLeadpageTemplateSourcesConfig()
        );
    }

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
    ): TemplatesSourcesInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->setSources(
                [
                    'leadpage_template_id' => $id,
                    'sources' => $this->extractor->extract(
                        $this->hydratorConfigFactory->createLeadpageTemplateSourcesConfig(),
                        $configuration
                    ),
                    'overwrite' => $overwrite
                ]
            ),
            'setSourcesResult',
            $this->hydratorConfigFactory->createLeadpageTemplateSourcesConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return LeadpageTemplateConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): LeadpageTemplateConfigurationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getConfiguration(
                [
                    'leadpage_template_id' => $id,
                ],
            ),
            'getConfigurationResult',
            $this->hydratorConfigFactory->createLeadpageTemplateConfigurationConfig(),
        );
    }

    /**
     * @param int $id
     * @param LeadpageTemplateConfigurationInterface $configuration
     *
     * @return LeadpageTemplateConfiguration
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $id,
        LeadpageTemplateConfigurationInterface $configuration
    ): LeadpageTemplateConfigurationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->setConfiguration(
                [
                    'leadpage_template_id' => $id,
                    'configuration' => $this->extractor->extract(
                        $this->hydratorConfigFactory->createLeadpageTemplateConfigurationConfig(),
                        $configuration,
                    ),
                ],
            ),
            'setConfigurationResult',
            $this->hydratorConfigFactory->createLeadpageTemplateConfigurationConfig(),
        );
    }

    /** @inheritdoc */
    public function removeAllArticles(int $id): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeAllArticles([
                'leadpage_template_id' => $id
            ]),
            'removeAllArticlesResult'
        );
    }

    /** @inheritdoc */
    public function removeArticles(int $id, array $referenceIds): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->removeArticles(
                [
                    'leadpage_template_id' => $id,
                    'reference_ids' => $referenceIds,
                ]
            ),
            'removeArticlesResult',
            $this->hydratorConfigFactory->createLeadpageArticleConfig()
        );
    }

    /** @inheritdoc */
    public function getArticlesByLeadpageTemplateId(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getArticles([
                'leadpage_template_id' => $id
            ]),
            'getArticlesResult',
            $this->hydratorConfigFactory->createLeadpageArticleConfig()
        );
    }

    /** @inheritdoc */
    public function addArticles(int $id, array $articles): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->addArticles(
                [
                    'leadpage_template_id' => $id,
                    'articles' => $this->extractor->extractArray(
                        $this->hydratorConfigFactory->createLeadpageArticleConfig(),
                        $articles
                    )
                ]
            ),
            'addArticlesResult',
            $this->hydratorConfigFactory->createLeadpageArticleConfig()
        );
    }

    /** @inheritdoc */
    public function removeSlot(int $id, int $slotId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeSlot([
                'leadpage_template_id' => $id,
                'slot_id' => $slotId
            ]),
            'removeSlotResult'
        );
    }

    /** @inheritdoc */
    public function removeTemplateFromSlot(
        int $id,
        int $slotId,
        int $templateType,
        int $articleTypeId = 0
    ): bool {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeTemplateFromSlot([
                'leadpage_template_id' => $id,
                'slot_id' => $slotId,
                'template_type' => $templateType,
                'article_type_id' => $articleTypeId
            ]),
            'removeTemplateFromSlotResult'
        );
    }

    /** @inheritdoc */
    public function getSlotConfiguration(int $id): LeadpageSlotConfigurationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getSlotConfiguration(['leadpage_template_id' => $id]),
            'getSlotConfigurationResult',
            $this->hydratorConfigFactory->createLeadpageSlotConfigurationConfig()
        );
    }

    /** @inheritdoc */
    public function addSlot(
        int $id,
        int $slotNumber
    ): LeadpageSlotInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->addSlot([
                'leadpage_template_id' => $id,
                'slot_number' => $slotNumber,
            ]),
            'addSlotResult',
            $this->hydratorConfigFactory->createLeadpageSlotConfig()
        );
    }

    /** @inheritdoc */
    public function updateSlot(
        int $id,
        int $slotId,
        int $slotNumber,
        string $name,
        int $sortTypeId,
        int $sortValue
    ): LeadpageSlotInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->updateSlot([
                'leadpage_template_id' => $id,
                'slot_id' => $slotId,
                'slot_number' => $slotNumber,
                'name' => $name,
                'sort_type_id' => $sortTypeId,
                'sort_value' => $sortValue
            ]),
            'updateSlotResult',
            $this->hydratorConfigFactory->createLeadpageSlotConfig()
        );
    }

    /** @inheritdoc */
    public function addTemplatesToSlot(
        int $id,
        int $slotId,
        HashMapInterface $config,
        int $articleTypeId = 0,
        array $allowed_templates = []
    ): LeadpageSlotItemInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->addTemplatesToSlot([
                'leadpage_template_id' => $id,
                'slot_id' => $slotId,
                'data' => $config,
                'article_type_id' => $articleTypeId,
                'allowed_templates' => $this->extractor->extractArray(
                    $this->hydratorConfigFactory->createLeadpageTemplateAllowedTemplatesConfig(),
                    $allowed_templates
                )
            ]),
            'addTemplatesToSlotResult',
            $this->hydratorConfigFactory->createLeadpageSlotItemConfig()
        );
    }

    /** @inheritdoc  */
    public function updateSlotTemplates(
        int $id,
        int $slotId,
        HashMapInterface $config,
        int $articleTypeId = 0,
        array $allowed_templates = []
    ): LeadpageSlotItemInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->updateSlotTemplates([
                'leadpage_template_id' => $id,
                'slot_id' => $slotId,
                'data' => $config,
                'article_type_id' => $articleTypeId,
                'allowed_templates' => $this->extractor->extractArray(
                    $this->hydratorConfigFactory->createLeadpageTemplateAllowedTemplatesConfig(),
                    $allowed_templates
                )
            ]),
            'updateSlotTemplatesResult',
            $this->hydratorConfigFactory->createLeadpageSlotItemConfig()
        );
    }
}
