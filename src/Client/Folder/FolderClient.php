<?php

namespace Scn\EvalancheSoapApiConnector\Client\Folder;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;

/**
 * Class FolderClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Folder
 */
final class FolderClient extends AbstractClient implements FolderClientInterface
{
    const PORTNAME = 'category';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param string $title
     * @param int $folderId
     *
     * @return FolderInformationInterface
     * @throws EmptyResultException
     */
    public function create(string $title, int $folderId): FolderInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->create(['name' => $title, 'parent_category_id' => $folderId]),
            'createResult',
            $this->hydratorConfigFactory->createFolderInformationConfig()
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
     * @return FolderInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSubFolderById(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getSubCategories(['category_id' => $id]),
            'getSubCategoriesResult',
            $this->hydratorConfigFactory->createFolderInformationConfig()
        );
    }
}
