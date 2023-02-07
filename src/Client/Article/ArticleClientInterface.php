<?php

namespace Scn\EvalancheSoapApiConnector\Client\Article;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleDetailInterface;
use Scn\EvalancheSoapStruct\Struct\Article\ArticleIndividualizationInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Interface ArticleClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Article
 */
interface ArticleClientInterface extends ClientInterface, ResourceTraitInterface
{
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
    ): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return HashMapInterface
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): HashMapInterface;

    /**
     * @param int $id
     * @param HashMapInterface $hashMap
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function update(int $id, HashMapInterface $hashMap): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return ArticleDetailInterface
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): ArticleDetailInterface;

    /**
     * @param int $articleTypeId
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByArticleTypeId(int $articleTypeId): array;

    /**
     * Return the article's individualization config
     *
     * @param int $id The article's id
     * @return ArticleIndividualizationInterface
     */
    public function getIndividualization(int $id): ArticleIndividualizationInterface;

    /**
     * Sets an article's individualization config
     *
     * @param int $id The article's id
     * @param ArticleIndividualizationInterface $individualization
     *
     * @return bool
     */
    public function setIndividualization(
        int $id,
        ArticleIndividualizationInterface $individualization
    ): bool;
}
