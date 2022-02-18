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
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param int $id
     *
     * @return FolderInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSubFolderById(int $id): array;

    /**
     * @param int $id
     *
     * @return FolderInformationInterface
     * @throws EmptyResultException
     */
    public function get(int $id): FolderInformationInterface;
}
