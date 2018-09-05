<?php

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Trait CreateResourceTrait
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Generic
 */
trait CreateResourceTrait
{
    /**
     * @param string $title
     * @param int $folderId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(string $title, int $folderId): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->create(['name' => $title, 'category_id' => $folderId]),
            'createResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }
}