<?php

namespace Scn\EvalancheSoapApiConnector\Client\Article;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

interface ArticleTemplateClientInterface extends ClientInterface, ResourceTraitInterface
{
    public const ARTICLE_TEMPLATE_HTML = 33;
    public const ARTICLE_TEMPLATE_TXT = 34;
    public const ARTICLE_TEMPLATE_PDF = 35;
    public const ARTICLE_TEMPLATE_WEB = 36;

    public function create(
        string $title,
        int $typeId,
        string $template,
        int $folderId
    ): ResourceInformationInterface;

    public function updateTemplate(
        int $templateId,
        string $template
    ): ResourceInformationInterface;
}
