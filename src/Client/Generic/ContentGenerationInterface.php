<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobStateInterface;

interface ContentGenerationInterface extends GetJobStateInterface
{
    /**
     * Runs the content-generation
     *
     * @throws EmptyResultException
     */
    public function runContentGeneration(
        int $id,
        HashMapInterface $variables
    ): JobStateInterface;
}
