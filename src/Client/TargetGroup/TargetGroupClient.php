<?php

namespace Scn\EvalancheSoapApiConnector\Client\TargetGroup;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\TargetGroup\TargetGroupDetailInterface;

/**
 * Class TargetGroupClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\TargetGroup
 */
final class TargetGroupClient extends AbstractClient implements TargetGroupClientInterface
{
    use ResourceTrait;

    const PORTNAME = 'targetgroup';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     * @param int $attributeId
     * @param int $optionId
     * @param int $categoryId
     * @param string $title
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function createByOption(
        int $id,
        int $attributeId,
        int $optionId,
        int $categoryId,
        string $title
    ): ResourceInformationInterface {
        return $this->responseMapper->getObject(
            $this->soapClient->createByOption([
                'pool_id' => $id,
                'attribute_id' => $attributeId,
                'option_id' => $optionId,
                'category_id' => $categoryId,
                'name' => $title
            ]),
            'createByOptionResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }

    /**
     * @param int $id
     *
     * @return TargetGroupDetailInterface
     * @throws EmptyResultException
     */
    public function getDetailById(int $id): TargetGroupDetailInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->getInformation([
                'targetgroup_id' => $id
            ]),
            'getInformationResult',
            $this->hydratorConfigFactory->createTargetGroupDetailConfig()
        );
    }
}