<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapStruct\Struct\Generic\JobStateInterface;

trait GetJobStateTrait
{
    /** @inheritDoc */
    public function getJobState(
        string $job_id,
    ): JobStateInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->getJobState([
                'job_id' => $job_id,
            ]),
            'getJobStateResult',
            $this->hydratorConfigFactory->createJobStateConfig()
        );
    }
}
