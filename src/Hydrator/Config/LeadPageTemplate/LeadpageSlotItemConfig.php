<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\LeadPageTemplate;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayValue;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageSlotItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

class LeadpageSlotItemConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new LeadpageSlotItem();
    }

    public function getHydratorProperties(): array
    {
        return [
            'article_type_id' => IntegerValue::set('articleTypeId'),
            'web_article_template_id' => IntegerValue::set('webArticleTemplateId'),
            'landingpage_article_template_id' => IntegerValue::set('landingpageArticleTemplateId'),
            'landingpage_allowed_article_template_ids' => ArrayValue::set('landingpageAllowedArticleTemplateIds'),
            'web_allowed_article_template_ids' => ArrayValue::set('webAllowedArticleTemplateIds'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'article_type_id' => IntegerValue::get('articleTypeId'),
            'web_article_template_id' => IntegerValue::get('webArticleTemplateId'),
            'landingpage_article_template_id' => IntegerValue::get('landingpageArticleTemplateId'),
            'landingpage_allowed_article_template_ids' => ArrayValue::get('landingpageAllowedArticleTemplateIds'),
            'web_allowed_article_template_ids' => ArrayValue::get('webAllowedArticleTemplateIds'),
        ];
    }
}
