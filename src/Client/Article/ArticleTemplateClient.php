<?php

namespace Scn\EvalancheSoapApiConnector\Client\Article;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;

/**
 * Class ArticleTemplateClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Article
 */
final class ArticleTemplateClient extends AbstractClient implements ArticleTemplateClientInterface
{
    use ResourceTrait;

    const PORTNAME = 'articletemplate';
    const VERSION = ClientInterface::VERSION_V0;
}
