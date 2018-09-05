<?php

namespace Scn\EvalancheSoapApiConnector\Client\Folder;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\FolderInformationInterface;

/**
 * Interface FolderClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Folder
 */
interface FolderClientInterface extends ClientInterface
{

    /**
     * @param string $title
     * @param int $folderId
     *
     * @return FolderInformationInterface
     * @throws EmptyResultException
     */
    public function create(string $title, int $folderId): FolderInformationInterface;

    /**
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void;

    /**
     * @param int $id
     *
     * @return FolderInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSubCategories(int $id): array;

}