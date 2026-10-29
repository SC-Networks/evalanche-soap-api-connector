<?php

namespace Scn\EvalancheSoapApiConnector\Extractor;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\Hydrator\HydratorInterface;

/**
 * Class Extractor
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator
 */
final readonly class Extractor implements ExtractorInterface
{
    public function __construct(private HydratorInterface $hydrator)
    {
    }

    /**
     * @param object $object
     */
    public function extract(HydratorConfigInterface $config, $object): array
    {
        return $this->filterArray($this->hydrator->extract($config, $object));
    }

    public function extractArray(HydratorConfigInterface $config, array $arrayOfObjects): array
    {
        $extractedData = [];

        foreach ($arrayOfObjects as $arrayOfObject) {
            $extractedData[] = $this->filterArray($this->hydrator->extract($config, $arrayOfObject));
        }

        return $this->filterArray($extractedData);
    }

    private function filterArray(array $array): array
    {
        return array_filter($array, fn ($value) => $value !== null && $value !== false);
    }
}
