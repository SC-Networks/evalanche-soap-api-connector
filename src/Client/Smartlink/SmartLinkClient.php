<?php

namespace Scn\EvalancheSoapApiConnector\Client\Smartlink;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTrait;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
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
}