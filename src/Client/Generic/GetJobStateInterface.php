<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\JobStateInterface;

interface GetJobStateInterface
{
    /**
     * Returns the state of a background-job
     *
     * @throws EmptyResultException
     */
    public function getJobState(
        string $job_id,
    ): JobStateInterface;
}
