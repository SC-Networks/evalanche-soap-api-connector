<?php

declare(strict_types=1);

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
    public function create(string $image, string $title, int $folderId): ResourceInformationInterface;
}
