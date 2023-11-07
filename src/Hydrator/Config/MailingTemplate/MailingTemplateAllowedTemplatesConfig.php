<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\MailingTemplate;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayValue;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateAllowedTemplates;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

class MailingTemplateAllowedTemplatesConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new MailingTemplateAllowedTemplates();
    }

    public function getHydratorProperties(): array
    {
        return [
            'template_type' => IntegerValue::set('templateType'),
            'template_ids' => ArrayValue::set('templateIds'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'template_type' => IntegerValue::get('templateType'),
            'template_ids' => ArrayValue::get('templateIds'),
        ];
    }
}
