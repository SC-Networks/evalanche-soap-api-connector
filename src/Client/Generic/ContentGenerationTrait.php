<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapStruct\Struct\Generic\HashMapInterface;
use Scn\EvalancheSoapStruct\Struct\Generic\JobStateInterface;

trait ContentGenerationTrait
{
    use GetJobStateTrait;

    /** @inheritDoc */
    public function runContentGeneration(
        int $id,
        HashMapInterface $variables
    ): JobStateInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->runContentGeneration([
                'resource_id' => $id,
                'variables' => $this->extractor->extract(
                    $this->hydratorConfigFactory->createHashMapConfig(),
                    $variables
                )
            ]),
            'runContentGenerationResult',
            $this->hydratorConfigFactory->createJobStateConfig()
        );
    }
}
