<?php

namespace Scn\EvalancheSoapApiConnector\Client\LeadPage;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageConfigurationInterface;

interface LeadpageClientInterface extends ResourceTraitInterface, ClientInterface
{
    /**
     * @param int $id
     * @param int $mandatorId
     *
     * @return ResourceInformationInterface[]
     */
    public function getByTypeId(int $id, int $mandatorId): array;

    /**
     * @param int $id
     *
     * @return ResourceInformationInterface
     * @throws EmptyResultException
     */
    public function getDetailsById(int $id): ResourceInformationInterface;

    /**
     * @param int $id
     *
     * @return LeadpageConfigurationInterface
     * @throws EmptyResultException
     */
    public function getConfiguration(int $id): LeadpageConfigurationInterface;

    /**
     * @param int $id
     * @param LeadpageConfigurationInterface $configuration
     *
     * @return LeadpageConfigurationInterface
     * @throws EmptyResultException
     */
    public function setConfiguration(
        int $id,
        LeadpageConfigurationInterface $configuration
    ): LeadpageConfigurationInterface;
}
