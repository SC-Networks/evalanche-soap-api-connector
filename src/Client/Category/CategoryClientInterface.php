<?php

namespace Scn\EvalancheSoapApiConnector\Client\Category;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\CategoryInformationInterface;

/**
 * Interface CategoryClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Category
 */
interface CategoryClientInterface extends ClientInterface
{

    /**
     * @param string $title
     * @param int $categoryId
     *
     * @return CategoryInformationInterface
     * @throws EmptyResultException
     */
    public function create(string $title, int $categoryId): CategoryInformationInterface;

    /**
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void;

    /**
     * @param int $id
     *
     * @return CategoryInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSubCategories(int $id): array;

}