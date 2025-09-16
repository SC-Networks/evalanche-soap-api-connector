<?php

namespace Scn\EvalancheSoapApiConnector\Client\Form;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Form\FormConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\Statistic\FormStatisticInterface;

/**
 * Class FormClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Form
 */
final class FormClient extends AbstractClient implements FormClientInterface
{
    use ResourceTrait;

    const PORTNAME = 'form';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     * @param int $poolAttributeId
     *
     * @return int
     * @throws EmptyResultException
     */
    public function addAttribute(int $id, int $poolAttributeId): int
    {
        return $this->responseMapper->getInteger(
            $this->soapClient->addAttribute(
                ['form_id' => $id, 'pool_attribute_id' => $poolAttributeId]
            ),
            'addAttributeResult'
        );
    }

    /**
     * @param int $id
     * @param int $optionId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function addAttributeOption(int $id, int $optionId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->addAttributeOption(
                ['form_id' => $id, 'option_id' => $optionId]
            ),
            'addAttributeOptionResult'
        );
    }

    /**
     * @param int $id
     * @param string $title
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function createAlias(int $id, string $title, int $folderId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->createAlias(
                ['form_id' => $id, 'name' => $title, 'category_id' => $folderId]
            ),
            'createAliasResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getAliases(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getAliases(
                ['form_id' => $id]
            ),
            'getAliasesResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getFormByAlias(int $id): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getFormByAlias(
                ['formalias_id' => $id]
            ),
            'getFormByAliasResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param bool $includeAliases
     *
     * @return FormStatisticInterface[]
     * @throws EmptyResultException
     */
    public function getStatistics(int $id, bool $includeAliases): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getStatistics(
                ['formular_id' => $id, 'with_aliases' => $includeAliases]
            ),
            'getStatisticsResult',
            $this->hydratorConfigFactory->createFormStatisticConfig()
        );
    }

    /**
     * @param int $id
     * @param int $formAttributeId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAttribute(int $id, int $formAttributeId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeAttribute(
                ['form_id' => $id, 'form_attribute_id' => $formAttributeId]
            ),
            'removeAttributeResult'
        );
    }

    /**
     * @param int $id
     * @param int $optionId
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function removeAttributeOption(int $id, int $optionId): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->removeAttributeOption(
                ['form_id' => $id, 'option_id' => $optionId]
            ),
            'removeAttributeOptionResult'
        );
    }

    /**
     * @param int $id
     * @param string $templateHtml
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function updateTemplate(int $id, string $templateHtml): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->updateTemplate(
                ['form_id' => $id, 'source' => $templateHtml]
            ),
            'updateTemplateResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    public function create(int $poolId, string $title): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->create(
                ['pool_id' => $poolId, 'name' => $title]
            ),
            'createResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

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
    ): FormConfigurationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->setConfiguration(
                [
                    'form_id' => $id,
                    'configuration' => $this->extractor->extract(
                        $this->hydratorConfigFactory->createFormConfigurationConfig(),
                        $configuration
                    ),
                ]
            ),
            'setConfigurationResult',
            $this->hydratorConfigFactory->createFormConfigurationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return FormConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): FormConfigurationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getConfiguration(
                [
                    'form_id' => $id,
                ]
            ),
            'getConfigurationResult',
            $this->hydratorConfigFactory->createFormConfigurationConfig()
        );
    }

    /** @inheritDoc */
    public function toggleHtmlTemplateMode(int $id, bool $enabled): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->toggleHtmlTemplateMode(
                [
                    'form_id' => $id,
                    'enabled' => $enabled,
                ]
            ),
            'toggleHtmlTemplateModeResult'
        );
    }
}
