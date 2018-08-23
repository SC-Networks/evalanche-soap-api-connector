<?php

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
     * @param string $title
     * @param int $categoryId
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function create(string $title, int $categoryId): ResourceInformationInterface;
}