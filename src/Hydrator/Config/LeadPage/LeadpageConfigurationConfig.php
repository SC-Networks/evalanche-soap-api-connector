<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\LeadPage;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\LeadPage\LeadpageConfiguration;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\StringValue;

class LeadpageConfigurationConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new LeadpageConfiguration();
    }

    public function getHydratorProperties(): array
    {
        return [
            'inputfield_0' => StringValue::set('inputfield0'),
            'inputfield_1' => StringValue::set('inputfield1'),
            'inputfield_2' => StringValue::set('inputfield2'),
            'inputfield_3' => StringValue::set('inputfield3'),
            'inputfield_4' => StringValue::set('inputfield4'),
            'inputfield_5' => StringValue::set('inputfield5'),
            'inputfield_6' => StringValue::set('inputfield6'),
            'inputfield_7' => StringValue::set('inputfield7'),
            'inputfield_8' => StringValue::set('inputfield8'),
            'inputfield_9' => StringValue::set('inputfield9'),
            'textarea_0' => StringValue::set('textarea0'),
            'textarea_1' => StringValue::set('textarea1'),
            'textarea_2' => StringValue::set('textarea2'),
            'textarea_3' => StringValue::set('textarea3'),
            'textarea_4' => StringValue::set('textarea4'),
            'textarea_5' => StringValue::set('textarea5'),
            'textarea_6' => StringValue::set('textarea6'),
            'textarea_7' => StringValue::set('textarea7'),
            'textarea_8' => StringValue::set('textarea8'),
            'textarea_9' => StringValue::set('textarea9'),
            'htmlarea_0' => StringValue::set('htmlarea0'),
            'htmlarea_1' => StringValue::set('htmlarea1'),
            'htmlarea_2' => StringValue::set('htmlarea2'),
            'htmlarea_3' => StringValue::set('htmlarea3'),
            'htmlarea_4' => StringValue::set('htmlarea4'),
            'htmlarea_5' => StringValue::set('htmlarea5'),
            'htmlarea_6' => StringValue::set('htmlarea6'),
            'htmlarea_7' => StringValue::set('htmlarea7'),
            'htmlarea_8' => StringValue::set('htmlarea8'),
            'htmlarea_9' => StringValue::set('htmlarea9'),
            'macro_library' => StringValue::set('macroLibrary'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'inputfield_0' => StringValue::get('inputfield0'),
            'inputfield_1' => StringValue::get('inputfield1'),
            'inputfield_2' => StringValue::get('inputfield2'),
            'inputfield_3' => StringValue::get('inputfield3'),
            'inputfield_4' => StringValue::get('inputfield4'),
            'inputfield_5' => StringValue::get('inputfield5'),
            'inputfield_6' => StringValue::get('inputfield6'),
            'inputfield_7' => StringValue::get('inputfield7'),
            'inputfield_8' => StringValue::get('inputfield8'),
            'inputfield_9' => StringValue::get('inputfield9'),
            'textarea_0' => StringValue::get('textarea0'),
            'textarea_1' => StringValue::get('textarea1'),
            'textarea_2' => StringValue::get('textarea2'),
            'textarea_3' => StringValue::get('textarea3'),
            'textarea_4' => StringValue::get('textarea4'),
            'textarea_5' => StringValue::get('textarea5'),
            'textarea_6' => StringValue::get('textarea6'),
            'textarea_7' => StringValue::get('textarea7'),
            'textarea_8' => StringValue::get('textarea8'),
            'textarea_9' => StringValue::get('textarea9'),
            'htmlarea_0' => StringValue::get('htmlarea0'),
            'htmlarea_1' => StringValue::get('htmlarea1'),
            'htmlarea_2' => StringValue::get('htmlarea2'),
            'htmlarea_3' => StringValue::get('htmlarea3'),
            'htmlarea_4' => StringValue::get('htmlarea4'),
            'htmlarea_5' => StringValue::get('htmlarea5'),
            'htmlarea_6' => StringValue::get('htmlarea6'),
            'htmlarea_7' => StringValue::get('htmlarea7'),
            'htmlarea_8' => StringValue::get('htmlarea8'),
            'htmlarea_9' => StringValue::get('htmlarea9'),
            'macro_library' => StringValue::get('macroLibrary'),
        ];
    }
}
