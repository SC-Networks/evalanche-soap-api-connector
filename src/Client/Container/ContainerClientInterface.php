<?php

namespace Scn\EvalancheSoapApiConnector\Client\Container;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Interface ContainerClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Container
 */
interface ContainerClientInterface extends ClientInterface, ResourceTraitInterface, CreateResourceTraitInterface
{
    /**
     * @param int $id
     *
     * @return HashMapInterface
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): HashMapInterface;

    /**
     * @param int $id
     * @param HashMapInterface $hashMap
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function update(int $id, HashMapInterface $hashMap): ResourceInformationInterface;
}