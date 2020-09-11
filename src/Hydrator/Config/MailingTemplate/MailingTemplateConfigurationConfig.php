<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\MailingTemplate;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing\MailingConfigurationConfig;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateConfiguration;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

class MailingTemplateConfigurationConfig extends MailingConfigurationConfig
{
    public function getObject(): StructInterface
    {
        return new MailingTemplateConfiguration();
    }
}
