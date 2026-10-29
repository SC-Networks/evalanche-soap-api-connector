<?php

declare(strict_types=1);

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
     *
     * @throws EmptyResultException
     */
    public function create(
        int $id,
        string $title,
        int $folderId,
        HashMapInterface $hashMap
    ): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): HashMapInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function update(int $id, HashMapInterface $hashMap): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): ArticleDetailInterface;

    /**
     *
     * @return ResourceInformationInterface[]
     * @throws EmptyResultException
     */
    public function getByArticleTypeId(int $articleTypeId): array;

    /**
     * Return the article's individualization config
     *
     * @param int $id The article's id
     */
    public function getIndividualization(int $id): ArticleIndividualizationInterface;

    /**
     * Sets an article's individualization config
     *
     * @param int $id The article's id
     */
    public function setIndividualization(
        int $id,
        ArticleIndividualizationInterface $individualization
    ): bool;
}
