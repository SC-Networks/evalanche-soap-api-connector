<?php

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
     * @param int $id
     * @param int $attributeId
     * @param int $optionId
     * @param int $folderId
     * @param string $title
     *
     * @return ResourceInformationInterface
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
     * @param int $id
     *
     * @return TargetGroupDetailInterface
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): TargetGroupDetailInterface;
}