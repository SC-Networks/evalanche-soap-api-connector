<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config;

use Scn\Hydrator\Configuration\ExtractorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\Hydrator\Configuration;

/**
 * Interface HydratorConfigInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator
 */
interface HydratorConfigInterface extends ExtractorConfigInterface, Configuration\HydratorConfigInterface
{
    public function getObject(): StructInterface;

    public function getHydratorProperties(): array;

    public function getExtractorProperties(): array;
}
