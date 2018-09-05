<?php

namespace Scn\EvalancheSoapApiConnector\Client\Form;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
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
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
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
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
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
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
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
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
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
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
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
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
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
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
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
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
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
     * @param string $title
     *
     * @return ResourceInformationInterface
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
     */
    public function updateTitle(int $id, string $title): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->rename(
                ['resource_id' => $id, 'name' => $title]
            ),
            'renameResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     * @param string $templateHtml
     *
     * @return ResourceInformationInterface
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
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
}