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
     *
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
