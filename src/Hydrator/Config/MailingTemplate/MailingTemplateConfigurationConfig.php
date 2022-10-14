<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\MailingTemplate;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\MailingTemplate\MailingTemplateConfiguration;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\StringValue;

class MailingTemplateConfigurationConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MailingTemplateConfiguration();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'external_trackingcode' => StringValue::set('externalTrackingCode'),
            'campaign_id' => StringValue::set('campaignId'),
            'externalxml_url' => StringValue::set('externalXmlUrl'),
            'salutation_female' => StringValue::set('salutationFemale'),
            'salutation_male' => StringValue::set('salutationMale'),
            'salutation_company' => StringValue::set('salutationCompany'),
            'salutation_family' => StringValue::set('salutationFamily'),
            'salutation_other' => StringValue::set('salutationOther'),
            'sender_email' => StringValue::set('senderEmail'),
            'sender_name' => StringValue::set('senderName'),
            'reply_name' => StringValue::set('replyName'),
            'reply_email' => StringValue::set('replyEmail'),
            'grant_url' => StringValue::set('grantUrl'),
            'revoke_url' => StringValue::set('revokeUrl'),
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
            'containerType' => StringValue::set('containerType'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'external_trackingcode' => StringValue::get('externalTrackingCode'),
            'campaign_id' => StringValue::get('campaignId'),
            'externalxml_url' => StringValue::get('externalXmlUrl'),
            'salutation_female' => StringValue::get('salutationFemale'),
            'salutation_male' => StringValue::get('salutationMale'),
            'salutation_company' => StringValue::get('salutationCompany'),
            'salutation_family' => StringValue::get('salutationFamily'),
            'salutation_other' => StringValue::get('salutationOther'),
            'sender_email' => StringValue::get('senderEmail'),
            'sender_name' => StringValue::get('senderName'),
            'reply_name' => StringValue::get('replyName'),
            'reply_email' => StringValue::get('replyEmail'),
            'grant_url' => StringValue::get('grantUrl'),
            'revoke_url' => StringValue::get('revokeUrl'),
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
            'containerType' => StringValue::get('containerType'),
        ];
    }
}
