<?php

namespace Scn\EvalancheSoapApiConnector\Client\Pool;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Interface PoolDataMinerClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Pool
 */
interface PoolDataMinerClientInterface extends ClientInterface, ResourceTraitInterface
{
    /**
     * @param int $id
     * @param string $title
     *
     * @return ResourceInformationInterface
     */
    public function updateTitle(int $id, string $title): ResourceInformationInterface;

}