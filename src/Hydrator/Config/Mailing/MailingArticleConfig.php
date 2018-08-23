<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingArticle;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'id' => Property\IntegerValue::set('id'),
            'article_id' => Property\IntegerValue::set('articleId'),
            'targetgroup_id' => Property\IntegerValue::set('targetGroupId'),
            'html_preset_id' => Property\IntegerValue::set('htmlPresetId'),
            'text_preset_id' => Property\IntegerValue::set('textPresetId'),
            'landingpage_preset_id' => Property\IntegerValue::set('landingpagePresetId'),
            'pdf_preset_id' => Property\IntegerValue::set('pdfPresetId'),
            'mobile_preset_id' => Property\IntegerValue::set('mobilePresetId'),
            'sort_pos' => Property\IntegerValue::set('sortPos'),
            'slot' => Property\IntegerValue::set('slot'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'article_id' => Property\IntegerValue::get('articleId'),
            'targetgroup_id' => Property\IntegerValue::get('targetGroupId'),
            'html_preset_id' => Property\IntegerValue::get('htmlPresetId'),
            'text_preset_id' => Property\IntegerValue::get('textPresetId'),
            'landingpage_preset_id' => Property\IntegerValue::get('landingpagePresetId'),
            'pdf_preset_id' => Property\IntegerValue::get('pdfPresetId'),
            'mobile_preset_id' => Property\IntegerValue::get('mobilePresetId'),
            'sort_pos' => Property\IntegerValue::get('sortPos'),
            'slot' => Property\IntegerValue::get('slot'),
        ];
    }
}