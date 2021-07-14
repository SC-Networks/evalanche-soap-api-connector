<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Form;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Form\FormConfiguration;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class FormConfigurationConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Form
 */
class FormConfigurationConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new FormConfiguration();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'unique_entry_criteria_id' => StringValue::set('uniqueEntryCriteriaId'),
            'block_duplicates' => StringValue::set('blockDuplicates'),
            'do_not_reset_unsubscription' => StringValue::set('doNotResetUnsubscription'),
            'permission_mode' => StringValue::set('permissionMode'),
            'enable_post_address_validation' => StringValue::set('enablePostAddressValidation'),
            'success_url' => StringValue::set('successUrl'),
            'emailing_id' => StringValue::set('emailingId'),
            'emailing_targetgroup_id' => StringValue::set('emailingTargetgroupId'),
            'newsletter_bcc_recipient_email' => StringValue::set('newsletterBccRecipientEmail'),
            'inquiry_emailing_id' => StringValue::set('inquiryEmailingId'),
            'inquiry_send_on_change' => StringValue::set('inquirySendOnChange'),
            'inquiry_recipient_emails' => StringValue::set('inquiryRecipientEmails'),
            'form_language' => StringValue::set('formLanguage'),
            'enable_automated_entry_protection' => StringValue::set('enableAutomatedEntryProtection'),
            're_captcha_activated' => StringValue::set('reCaptchaActivated'),
            'is_mobile_optimized' => StringValue::set('isMobileOptimized'),
            'is_auto_submit_form' => StringValue::set('isAutoSubmitForm'),
            'validation_form_id' => StringValue::set('validationFormId'),
            'auto_form_action_activated' => StringValue::set('autoFormActionActivated'),
            'form_api_state' => StringValue::set('formApiState'),
            'form_api_cors_domains' => StringValue::set('formApiCorsDomains'),
            'external_trackingcode' => StringValue::set('externalTrackingcode'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'unique_entry_criteria_id' => StringValue::get('uniqueEntryCriteriaId'),
            'block_duplicates' => StringValue::get('blockDuplicates'),
            'do_not_reset_unsubscription' => StringValue::get('doNotResetUnsubscription'),
            'permission_mode' => StringValue::get('permissionMode'),
            'enable_post_address_validation' => StringValue::get('enablePostAddressValidation'),
            'success_url' => StringValue::get('successUrl'),
            'emailing_id' => StringValue::get('emailingId'),
            'emailing_targetgroup_id' => StringValue::get('emailingTargetgroupId'),
            'newsletter_bcc_recipient_email' => StringValue::get('newsletterBccRecipientEmail'),
            'inquiry_emailing_id' => StringValue::get('inquiryEmailingId'),
            'inquiry_send_on_change' => StringValue::get('inquirySendOnChange'),
            'inquiry_recipient_emails' => StringValue::get('inquiryRecipientEmails'),
            'form_language' => StringValue::get('formLanguage'),
            'enable_automated_entry_protection' => StringValue::get('enableAutomatedEntryProtection'),
            're_captcha_activated' => StringValue::get('reCaptchaActivated'),
            'is_mobile_optimized' => StringValue::get('isMobileOptimized'),
            'is_auto_submit_form' => StringValue::get('isAutoSubmitForm'),
            'validation_form_id' => StringValue::get('validationFormId'),
            'auto_form_action_activated' => StringValue::get('autoFormActionActivated'),
            'form_api_state' => StringValue::get('formApiState'),
            'form_api_cors_domains' => StringValue::get('formApiCorsDomains'),
            'external_trackingcode' => StringValue::get('externalTrackingcode'),
        ];
    }
}
