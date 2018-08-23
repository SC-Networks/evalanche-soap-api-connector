<?php

namespace Scn\EvalancheSoapApiConnector\Client\Category;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\CategoryInformationInterface;

/**
 * Class CategoryClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Category
 */
final class CategoryClient extends AbstractClient implements CategoryClientInterface
{
    const PORTNAME = 'category';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param string $title
     * @param int $categoryId
     *
     * @return CategoryInformationInterface
     * @throws EmptyResultException
     */
    public function create(string $title, int $categoryId): CategoryInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->create(['name' => $title, 'parent_category_id' => $categoryId]),
            'createResult',
            $this->hydratorConfigFactory->createCategoryInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $this->soapClient->delete(['category_id' => $id]);
    }

    /**
     * @param int $id
     *
     * @return CategoryInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSubCategories(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getSubCategories(['category_id' => $id]),
            'getSubCategoriesResult',
            $this->hydratorConfigFactory->createCategoryInformationConfig()
        );
    }
}