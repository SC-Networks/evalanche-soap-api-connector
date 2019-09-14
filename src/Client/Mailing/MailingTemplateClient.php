<?php

namespace Scn\EvalancheSoapApiConnector\Client\Mailing;

use Scn\EvalancheSoapApiConnector\Client\AbstractClient;
use Scn\EvalancheSoapApiConnector\Client\ClientInterface;
use Scn\EvalancheSoapApiConnector\Client\Generic\ResourceTrait;
use Scn\EvalancheSoapStruct\Struct\Generic\ResourceInformationInterface;

/**
 * Class MailingTemplateClient
 *
 * @package Scn\EvalancheSoapApiConnector\Client\Mailing
 */
class MailingTemplateClient extends AbstractClient implements MailingTemplateClientInterface
{
    use ResourceTrait;

    const PORTNAME = 'mailingtemplate';
    const VERSION = ClientInterface::VERSION_V0;

    /**
     * @param int $id
     * @param string $title
     *
     * @return ResourceInformationInterface
     * @throws \Scn\EvalancheSoapApiConnector\Exception\EmptyResultException
     */
    public function updateTitle(int $id, string $title): ResourceInformationInterface
    {
        return $this->responseMapper->getObject(
            $this->soapClient->rename(['resource_id' => $id, 'name' => $title]),
            'renameResult',
            $this->hydratorConfigFactory->createResourceInformationConfig()
        );
    }
}
