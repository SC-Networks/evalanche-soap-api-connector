<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingConfiguration;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

/**
 * Class MailingConfigurationConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingConfigurationConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MailingConfiguration();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'external_trackingcode' => Property\TextValue::set('externalTrackingCode'),
            'campaign_id' => Property\TextValue::set('campaignId'),
            'externalxml_url' => Property\TextValue::set('externalXmlUrl'),
            'salutation_female' => Property\TextValue::set('salutationFemale'),
            'salutation_male' => Property\TextValue::set('salutationMale'),
            'salutation_company' => Property\TextValue::set('salutationCompany'),
            'salutation_family' => Property\TextValue::set('salutationFamily'),
            'salutation_other' => Property\TextValue::set('salutationOther'),
            'sender_email' => Property\TextValue::set('senderEmail'),
            'sender_name' => Property\TextValue::set('senderName'),
            'reply_name' => Property\TextValue::set('replyName'),
            'reply_email' => Property\TextValue::set('replyEmail'),
            'grant_url' => Property\TextValue::set('grantUrl'),
            'revoke_url' => Property\TextValue::set('revokeUrl'),
            'inputfield_0' => Property\TextValue::set('inputfield0'),
            'inputfield_1' => Property\TextValue::set('inputfield1'),
            'inputfield_2' => Property\TextValue::set('inputfield2'),
            'inputfield_3' => Property\TextValue::set('inputfield3'),
            'inputfield_4' => Property\TextValue::set('inputfield4'),
            'inputfield_5' => Property\TextValue::set('inputfield5'),
            'inputfield_6' => Property\TextValue::set('inputfield6'),
            'inputfield_7' => Property\TextValue::set('inputfield7'),
            'inputfield_8' => Property\TextValue::set('inputfield8'),
            'inputfield_9' => Property\TextValue::set('inputfield9'),
            'textarea_0' => Property\TextValue::set('textarea0'),
            'textarea_1' => Property\TextValue::set('textarea1'),
            'textarea_2' => Property\TextValue::set('textarea2'),
            'textarea_3' => Property\TextValue::set('textarea3'),
            'textarea_4' => Property\TextValue::set('textarea4'),
            'textarea_5' => Property\TextValue::set('textarea5'),
            'textarea_6' => Property\TextValue::set('textarea6'),
            'textarea_7' => Property\TextValue::set('textarea7'),
            'textarea_8' => Property\TextValue::set('textarea8'),
            'textarea_9' => Property\TextValue::set('textarea9'),
            'htmlarea_0' => Property\TextValue::set('htmlarea0'),
            'htmlarea_1' => Property\TextValue::set('htmlarea1'),
            'htmlarea_2' => Property\TextValue::set('htmlarea2'),
            'htmlarea_3' => Property\TextValue::set('htmlarea3'),
            'htmlarea_4' => Property\TextValue::set('htmlarea4'),
            'htmlarea_5' => Property\TextValue::set('htmlarea5'),
            'htmlarea_6' => Property\TextValue::set('htmlarea6'),
            'htmlarea_7' => Property\TextValue::set('htmlarea7'),
            'htmlarea_8' => Property\TextValue::set('htmlarea8'),
            'htmlarea_9' => Property\TextValue::set('htmlarea9'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'external_trackingcode' => Property\TextValue::get('externalTrackingCode'),
            'campaign_id' => Property\TextValue::get('campaignId'),
            'externalxml_url' => Property\TextValue::get('externalXmlUrl'),
            'salutation_female' => Property\TextValue::get('salutationFemale'),
            'salutation_male' => Property\TextValue::get('salutationMale'),
            'salutation_company' => Property\TextValue::get('salutationCompany'),
            'salutation_family' => Property\TextValue::get('salutationFamily'),
            'salutation_other' => Property\TextValue::get('salutationOther'),
            'sender_email' => Property\TextValue::get('senderEmail'),
            'sender_name' => Property\TextValue::get('senderName'),
            'reply_name' => Property\TextValue::get('replyName'),
            'reply_email' => Property\TextValue::get('replyEmail'),
            'grant_url' => Property\TextValue::get('grantUrl'),
            'revoke_url' => Property\TextValue::get('revokeUrl'),
            'inputfield_0' => Property\TextValue::get('inputfield0'),
            'inputfield_1' => Property\TextValue::get('inputfield1'),
            'inputfield_2' => Property\TextValue::get('inputfield2'),
            'inputfield_3' => Property\TextValue::get('inputfield3'),
            'inputfield_4' => Property\TextValue::get('inputfield4'),
            'inputfield_5' => Property\TextValue::get('inputfield5'),
            'inputfield_6' => Property\TextValue::get('inputfield6'),
            'inputfield_7' => Property\TextValue::get('inputfield7'),
            'inputfield_8' => Property\TextValue::get('inputfield8'),
            'inputfield_9' => Property\TextValue::get('inputfield9'),
            'textarea_0' => Property\TextValue::get('textarea0'),
            'textarea_1' => Property\TextValue::get('textarea1'),
            'textarea_2' => Property\TextValue::get('textarea2'),
            'textarea_3' => Property\TextValue::get('textarea3'),
            'textarea_4' => Property\TextValue::get('textarea4'),
            'textarea_5' => Property\TextValue::get('textarea5'),
            'textarea_6' => Property\TextValue::get('textarea6'),
            'textarea_7' => Property\TextValue::get('textarea7'),
            'textarea_8' => Property\TextValue::get('textarea8'),
            'textarea_9' => Property\TextValue::get('textarea9'),
            'htmlarea_0' => Property\TextValue::get('htmlarea0'),
            'htmlarea_1' => Property\TextValue::get('htmlarea1'),
            'htmlarea_2' => Property\TextValue::get('htmlarea2'),
            'htmlarea_3' => Property\TextValue::get('htmlarea3'),
            'htmlarea_4' => Property\TextValue::get('htmlarea4'),
            'htmlarea_5' => Property\TextValue::get('htmlarea5'),
            'htmlarea_6' => Property\TextValue::get('htmlarea6'),
            'htmlarea_7' => Property\TextValue::get('htmlarea7'),
            'htmlarea_8' => Property\TextValue::get('htmlarea8'),
            'htmlarea_9' => Property\TextValue::get('htmlarea9'),
        ];
    }
}
