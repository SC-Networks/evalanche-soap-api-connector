<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
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
        ];
    }
}