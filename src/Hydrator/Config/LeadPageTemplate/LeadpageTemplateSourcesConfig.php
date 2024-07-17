<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\LeadPageTemplate;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPageTemplate\TemplatesSources;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\StringValue;

class LeadpageTemplateSourcesConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new TemplatesSources();
    }

    public function getHydratorProperties(): array
    {
        return [
            'web' => StringValue::set('templateWeb'),
            'landingpage' => StringValue::set('templateLandingpage'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'web' => StringValue::get('templateWeb'),
            'landingpage' => StringValue::get('templateLandingpage'),
        ];
    }
}
