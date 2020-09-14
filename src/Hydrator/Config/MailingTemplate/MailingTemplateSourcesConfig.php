<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\MailingTemplate;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplatesSources;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\StringValue;

class MailingTemplateSourcesConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new MailingTemplatesSources();
    }

    public function getHydratorProperties(): array
    {
        return [
            'email' => StringValue::set('templateEmail'),
            'text' => StringValue::set('templateText'),
            'web' => StringValue::set('templateWeb'),
            'pdf' => StringValue::set('templatePdf'),
            'landingpage' => StringValue::set('templateLandingpage'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'email' => StringValue::get('templateEmail'),
            'text' => StringValue::get('templateText'),
            'web' => StringValue::get('templateWeb'),
            'pdf' => StringValue::get('templatePdf'),
            'landingpage' => StringValue::get('templateLandingpage'),
        ];
    }
}
