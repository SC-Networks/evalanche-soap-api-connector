<?php

namespace Scn\EvalancheSoapApiConnector\Client\Smartlink;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTrait;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkConfigurationInterface;
use Scn\EvalancheSoapStruct\Struct\SmartLink\SmartLinkInterface;

/**
 * Class SmartLinkClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Smartlink
 */
final class SmartLinkClient extends AbstractClient implements SmartLinkClientInterface
{
    use ResourceTrait;
    use CreateResourceTrait;

    const PORTNAME = 'smartlink';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * Appends a new link to an existing smartlink object
     *
     * @param int $id
     * @param string $title
     * @param string $url
     *
     * @return string
     * @throws EmptyResultException
     */
    public function createLink(int $id, string $title, string $url): string
    {
        return $this->responseMapper->getString(
            $this->soapClient->createLink([
                'smartlink_id' => $id,
                'link_name' => $title,
                'link_url' => $url
            ]),
            'createLinkResult'
        );
    }

    /**
     * Get all Links from a SmartLink Object
     *
     * @param int $id
     *
     * @return SmartLinkInterface[]
     * @throws EmptyResultException
     */
    public function getTrackingUrls(int $id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getTrackingUrls(['smartlink_id' => $id]),
            'getTrackingUrlsResult',
            $this->hydratorConfigFactory->createSmartLinkConfig()
        );
    }

    /**
     * Get all link configurations from a SmartLink object
     *
     * @param int $link_id
     *
     * @return SmartLinkConfigurationInterface[]
     * @throws EmptyResultException
     */
    public function getLinkConfigurations(int $link_id): array
    {
        return $this->responseMapper->getObjects(
            $this->soapClient->getLinkConfigurations(['smartlink_link_id' => $link_id]),
            'getLinkConfigurationsResult',
            $this->hydratorConfigFactory->createSmartLinkConfigurationConfig()
        );
    }

    /**
     * Updates all given link configurations from a SmartLink object
     *
     * @param int $link_id
     * @param SmartLinkConfigurationInterface[] $configurations
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function setLinkConfigurations(int $link_id, array $configurations): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->setLinkConfigurations([
                'smartlink_link_id' => $link_id,
                'items' => $this->extractor->extractArray(
                    $this->hydratorConfigFactory->createSmartLinkConfigurationConfig(),
                    $configurations
                ),
            ]),
            'setLinkConfigurationsResult'
        );
    }

    /**
     * Creates link configurations for a SmartLink object
     *
     * @param int $link_id
     * @param SmartLinkConfigurationInterface[] $configurations
     *
     * @return bool
     * @throws EmptyResultException
     */
    public function createLinkConfigurations(int $link_id, array $configurations): bool
    {
        return $this->responseMapper->getBoolean(
            $this->soapClient->createLinkConfigurations([
                'smartlink_link_id' => $link_id,
                'items' => $this->extractor->extractArray(
                    $this->hydratorConfigFactory->createSmartLinkConfigurationConfig(),
                    $configurations
                ),
            ]),
            'createLinkConfigurationsResult'
        );
    }
}
