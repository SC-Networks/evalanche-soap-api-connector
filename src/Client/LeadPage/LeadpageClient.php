<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\LeadPage;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\EditorModuleTypesTrait;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageConfigurationInterface;

class LeadpageClient extends AbstractClient implements LeadpageClientInterface
{
    use ResourceTrait;
    use EditorModuleTypesTrait;
    const PORTNAME = 'leadpage';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getDetails(
                [
                    'leadpage_id' => $id,
                ]
            ),
            'getDetailsResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return LeadpageConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): LeadpageConfigurationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getConfiguration(
                [
                    'leadpage_id' => $id,
                ]
            ),
            'getConfigurationResult',
            $this->hydratorConfigFactory->createLeadpageConfigurationConfig()
        );
    }

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
    ): LeadpageConfigurationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->setConfiguration(
                [
                    'leadpage_id' => $id,
                    'configuration' => $this->extractor->extract(
                        $this->hydratorConfigFactory->createLeadpageConfigurationConfig(),
                        $configuration
                    ),
                ]
            ),
            'setConfigurationResult',
            $this->hydratorConfigFactory->createLeadpageConfigurationConfig()
        );
    }

    /**
     * @param int $leadpageId
     *
     * @return HashMapInterface
     * @throws EmptyResultException
     */
    public function getContentContainerData(int $leadpageId): HashMapInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getContentContainerData([
                'resource_id' => $leadpageId
            ]),
            'getContentContainerDataResult',
            $this->hydratorConfigFactory->createHashMapConfig()
        );
    }

    /**
     * @param int $leadpageId
     * @param HashMapInterface $hashMap
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function setContentContainerData(int $leadpageId, HashMapInterface $hashMap): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->setContentContainerData([
                'resource_id' => $leadpageId,
                'data' => $this->extractor->extract(
                    $this->hydratorConfigFactory->createHashMapConfig(),
                    $hashMap
                )
            ]),
            'setContentContainerDataResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }
}
