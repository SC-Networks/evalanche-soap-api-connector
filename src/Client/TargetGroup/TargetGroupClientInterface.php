<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\TargetGroup;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupDetailInterface;

/**
 * Interface TargetGroupClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\TargetGroup
 */
interface TargetGroupClientInterface extends ClientInterface, ResourceTraitInterface
{
    /**
     *
     * @throws EmptyResultException
     */
    public function createByOption(
        int $id,
        int $attributeId,
        int $optionId,
        int $folderId,
        string $title
    ): ResourceInformationInterface;

    /**
     *
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): TargetGroupDetailInterface;
}
