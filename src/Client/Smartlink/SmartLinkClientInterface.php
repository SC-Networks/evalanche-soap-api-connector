<?php

namespace Scn\EvalancheSoapApiConnector\Client\Smartlink;

use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\CreateResourceTraitInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTraitInterface;
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
}
