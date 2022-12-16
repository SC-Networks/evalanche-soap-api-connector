<?php

namespace Scn\EvalancheSoapApiConnector\Client\Article;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleDetailInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Class ArticleClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Article
 */
final class ArticleClient extends AbstractClient implements ArticleClientInterface
{
    use ResourceTrait;

    const PORTNAME = 'article';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     * @param string $title
     * @param int $folderId
     * @param HashMapInterface $hashMap
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(
        int $id,
        string $title,
        int $folderId,
        HashMapInterface $hashMap
    ): ResourceInformationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->create(
                [
                    'article_preset_id' => $id,
                    'name' => $title,
                    'category_id' => $folderId,
                    'data' => $this->extractor->extract(
                        $this->hydratorConfigFactory->createHashMapConfig(),
                        $hashMap
                    ),
                ]
            ),
            'createResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return HashMapInterface
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): HashMapInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getData(
                ['article_id' => $id]
            ),
            'getDataResult',
            $this->hydratorConfigFactory->createHashMapConfig()
        );
    }

    /**
     * @param int $id
     * @param HashMapInterface $hashMap
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function update(int $id, HashMapInterface $hashMap): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->update([
                'article_id' => $id,
                'data' => $this->extractor->extract(
                    $this->hydratorConfigFactory->createHashMapConfig(),
                    $hashMap
                )
            ]),
            'updateResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return ArticleDetailInterface
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): ArticleDetailInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getDetails(
                [
                    'article_id' => $id,
                ]
            ),
            'getDetailsResult',
            $this->hydratorConfigFactory->createArticleDetailConfig()
        );
    }
}
