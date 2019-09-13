<?php

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
     * @param HydratorConfigInterface $config
     * @param object $object
     *
     * @return array
     */
    public function extract(HydratorConfigInterface $config, $object): array;

    /**
     * @param HydratorConfigInterface $config
     * @param array $arrayOfObjects
     *
     * @return array
     */
    public function extractArray(HydratorConfigInterface $config, array $arrayOfObjects): array;
}
