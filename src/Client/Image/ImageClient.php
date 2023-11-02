<?php

namespace Scn\EvalancheSoapApiConnector\Client\Image;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Class ImageClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Image
 */
final class ImageClient extends AbstractClient implements ImageClientInterface
{
    use ResourceTrait;
    const PORTNAME = 'image';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param string $image
     * @param string $title
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(string $image, string $title, int $folderId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->create(['image_base64' => $image, 'name' => $title, 'category_id' => $folderId]),
            'createResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }
}
