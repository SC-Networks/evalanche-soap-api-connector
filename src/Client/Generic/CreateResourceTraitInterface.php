<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Generic;

use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Interface CreateResourceTraitInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Generic
 */
interface CreateResourceTraitInterface
{
    /**
     *
     * @throws EmptyResultException
     */
    public function create(string $title, int $folderId): ResourceInformationInterface;
}
