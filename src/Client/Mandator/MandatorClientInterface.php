<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mandator;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapStruct\Struct\Mandator\MandatorInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Interface MandatorClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mandator
 */
interface MandatorClientInterface extends ClientInterface
{
    /**
     * @param int $id
     *
     * @return MandatorInterface
     */
    public function getById(int $id): StructInterface;

    /**
     *
     * @return MandatorInterface[]
     */
    public function getList(): array;

}