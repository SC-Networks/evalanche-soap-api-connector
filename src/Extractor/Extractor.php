<?php

namespace Scn\EvalancheSoapApiConnector\Extractor;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\Hydrator\Hydrator;
use Scn\Hydrator\HydratorInterface;

/**
 * Class Extractor
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator
 */
final class Extractor implements ExtractorInterface
{
    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * @param HydratorInterface $hydrator
     */
    public function __construct(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @param HydratorConfigInterface $config
     * @param object $object
     *
     * @return array
     */
    public function extract(HydratorConfigInterface $config, $object): array
    {
        return array_filter($this->hydrator->extract($config, $object));
    }

    /**
     * @param HydratorConfigInterface $config
     * @param array $arrayOfObjects
     *
     * @return array
     */
    public function extractArray(HydratorConfigInterface $config, array $arrayOfObjects): array
    {
        $extractedData = [];

        foreach ($arrayOfObjects as $arrayOfObject) {
            $extractedData[] = array_filter($this->hydrator->extract($config, $arrayOfObject));
        }

        return array_filter($extractedData);
    }
}