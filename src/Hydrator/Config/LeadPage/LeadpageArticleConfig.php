<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\LeadPage;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageArticle;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;

/**
 * Class LeadpageArticleConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Leadpage
 */
class LeadpageArticleConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new LeadpageArticle();
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
            'landingpage_preset_id' => IntegerValue::set('landingpagePresetId'),
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
            'landingpage_preset_id' => IntegerValue::get('landingpagePresetId'),
            'mobile_preset_id' => IntegerValue::get('mobilePresetId'),
            'sort_pos' => IntegerValue::get('sortPos'),
            'slot' => IntegerValue::get('slot'),
        ];
    }
}
