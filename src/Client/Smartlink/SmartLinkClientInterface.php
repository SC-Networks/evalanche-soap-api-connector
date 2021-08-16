<?php

namespace Scn\EvalancheSoapApiConnector\Client\Smartlink;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkInterface;

/**
 * Interface SmartLinkClientInterface
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Smartlink
 */
interface SmartLinkClientInterface extends ClientInterface, ResourceTraitInterface, CreateResourceTraitInterface
{
    /**
     * @param int $id
     * @param string $title
     * @param string $url
     *
     * @return string
     */
    public function createLink(int $id, string $title, string $url): string;

    /**
     * @param int $id
     *
     * @return SmartLinkInterface[]
     */
    public function getTrackingUrls(int $id): array;

    /**
     * Get all link configurations from a SmartLink Object
     *
     * @param int $link_id
     *
     * @return SmartLinkConfigurationInterface[]
     * @throws EmptyResultException
     */
    public function getLinkConfigurations(int $link_id): array;

    /**
     * Updates all given link configurations from a SmartLink object
     *
     * @param int $link_id
     * @param SmartLinkConfigurationInterface[] $configurations
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function setLinkConfigurations(int $link_id, array $configurations): bool;
}
