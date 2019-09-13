<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config;

use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\Hydrator\Configuration;

/**
 * Interface HydratorConfigInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator
 */
interface HydratorConfigInterface extends Configuration\ExtractorConfigInterface, Configuration\HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface;

    /**
     * @return array
     */
    public function getHydratorProperties(): array;

    /**
     * @return array
     */
    public function getExtractorProperties(): array;
}
