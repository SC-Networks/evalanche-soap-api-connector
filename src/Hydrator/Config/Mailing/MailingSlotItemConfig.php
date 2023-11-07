<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayValue;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSlotItem;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

class MailingSlotItemConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new MailingSlotItem();
    }

    public function getHydratorProperties(): array
    {
        return [
            'article_type_id' => IntegerValue::set('articleTypeId'),
            'email_article_template_id' => IntegerValue::set('emailArticleTemplateId'),
            'text_article_template_id' => IntegerValue::set('textArticleTemplateId'),
            'pdf_article_template_id' => IntegerValue::set('pdfArticleTemplateId'),
            'web_article_template_id' => IntegerValue::set('webArticleTemplateId'),
            'landingpage_article_template_id' => IntegerValue::set('landingpageArticleTemplateId'),
            'email_allowed_article_template_ids' => ArrayValue::set('emailAllowedArticleTemplateIds'),
            'text_allowed_article_template_ids' => ArrayValue::set('textAllowedArticleTemplateIds'),
            'landingpage_allowed_article_template_ids' => ArrayValue::set('landingpageAllowedArticleTemplateIds'),
            'web_allowed_article_template_ids' => ArrayValue::set('webAllowedArticleTemplateIds'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'article_type_id' => IntegerValue::get('articleTypeId'),
            'email_article_template_id' => IntegerValue::get('emailArticleTemplateId'),
            'text_article_template_id' => IntegerValue::get('textArticleTemplateId'),
            'pdf_article_template_id' => IntegerValue::get('pdfArticleTemplateId'),
            'web_article_template_id' => IntegerValue::get('webArticleTemplateId'),
            'landingpage_article_template_id' => IntegerValue::get('landingpageArticleTemplateId'),
            'email_allowed_article_template_ids' => ArrayValue::get('emailAllowedArticleTemplateIds'),
            'text_allowed_article_template_ids' => ArrayValue::get('textAllowedArticleTemplateIds'),
            'landingpage_allowed_article_template_ids' => ArrayValue::get('landingpageAllowedArticleTemplateIds'),
            'web_allowed_article_template_ids' => ArrayValue::get('webAllowedArticleTemplateIds'),
        ];
    }
}
