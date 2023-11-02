<?php

namespace Scn\EvalancheSoapApiConnector\Client\Image;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Interface ImageClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Image
 */
interface ImageClientInterface extends ResourceTraitInterface, ClientInterface
{
    /**
     * @param string $image
     * @param string $title
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     */
    public function create(string $image, string $title, int $folderId): ResourceInformationInterface;
}
