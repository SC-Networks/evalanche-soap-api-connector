<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\LeadPageTemplate;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
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
}
