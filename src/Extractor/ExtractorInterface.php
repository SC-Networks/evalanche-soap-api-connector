<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Extractor;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;

/**
 * Interface ExtractorInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator
 */
interface ExtractorInterface
{
    /**
     * @param object $object
     */
    public function extract(HydratorConfigInterface $config, $object): array;

    public function extractArray(HydratorConfigInterface $config, array $arrayOfObjects): array;
}
