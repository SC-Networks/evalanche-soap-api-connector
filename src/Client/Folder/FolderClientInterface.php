<?php

declare(strict_types=1);

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
     *
     * @throws EmptyResultException
     */
    public function create(string $title, int $folderId): FolderInformationInterface;

    public function delete(int $id): bool;

    /**
     *
     * @return FolderInformationInterface[]
     * @throws EmptyResultException
     */
    public function getSubFolderById(int $id): array;

    /**
     *
     * @throws EmptyResultException
     */
    public function get(int $id): FolderInformationInterface;
}
