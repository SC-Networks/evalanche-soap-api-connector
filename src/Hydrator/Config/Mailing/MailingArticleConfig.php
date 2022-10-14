<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingArticle;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

/**
 * Class MailingArticleConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingArticleConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MailingArticle();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'article_id' => IntegerValue::set('articleId'),
            'targetgroup_id' => IntegerValue::set('targetGroupId'),
            'html_preset_id' => IntegerValue::set('htmlPresetId'),
            'text_preset_id' => IntegerValue::set('textPresetId'),
            'landingpage_preset_id' => IntegerValue::set('landingpagePresetId'),
            'pdf_preset_id' => IntegerValue::set('pdfPresetId'),
            'mobile_preset_id' => IntegerValue::set('mobilePresetId'),
            'sort_pos' => IntegerValue::set('sortPos'),
            'slot' => IntegerValue::set('slot'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'article_id' => IntegerValue::get('articleId'),
            'targetgroup_id' => IntegerValue::get('targetGroupId'),
            'html_preset_id' => IntegerValue::get('htmlPresetId'),
            'text_preset_id' => IntegerValue::get('textPresetId'),
            'landingpage_preset_id' => IntegerValue::get('landingpagePresetId'),
            'pdf_preset_id' => IntegerValue::get('pdfPresetId'),
            'mobile_preset_id' => IntegerValue::get('mobilePresetId'),
            'sort_pos' => IntegerValue::get('sortPos'),
            'slot' => IntegerValue::get('slot'),
        ];
    }
}
