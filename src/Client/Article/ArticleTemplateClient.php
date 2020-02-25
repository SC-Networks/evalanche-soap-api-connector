<?php

namespace Scn\EvalancheSoapApiConnector\Client\Article;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

final class ArticleTemplateClient extends AbstractClient implements ArticleTemplateClientInterface
{
    use ResourceTrait;

    const PORTNAME = 'articletemplate';
    const VERSION = ClientInterface::VERSION_V0;

    public function create(
        string $title,
        int $typeId,
        string $template,
        int $folderId
    ): ResourceInformationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->create(
                [
                    'title' => $title,
                    'type_id' => $typeId,
                    'template' => $template,
                    'folder_id' => $folderId
                ]
            ),
            'createResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    public function updateTemplate(
        int $templateId,
        string $template
    ): ResourceInformationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->updateTemplate(
                [
                    'template_id' => $templateId,
                    'template' => $template
                ]
            ),
            'updateTemplateResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }
}
