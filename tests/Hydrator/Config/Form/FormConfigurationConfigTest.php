<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Form;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Form\FormConfigurationInterface;

/**
 * Class FormConfigurationConfigTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Form
 */
class FormConfigurationConfigTest extends TestCase
{
    /**
     * @var FormConfigurationConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'unique_entry_criteria_id',
        'block_duplicates',
        'do_not_reset_unsubscription',
        'permission_mode',
        'enable_post_address_validation',
        'success_url',
        'emailing_id',
        'emailing_targetgroup_id',
        'newsletter_bcc_recipient_email',
        'inquiry_emailing_id',
        'inquiry_send_on_change',
        'inquiry_recipient_emails',
        'form_language',
        'enable_automated_entry_protection',
        're_captcha_activated',
        'is_mobile_optimized',
        'is_auto_submit_form',
        'validation_form_id',
        'auto_form_action_activated',
        'form_api_state',
        'form_api_cors_domains',
        'external_trackingcode',
    ];

    public function setUp(): void
    {
        $this->subject = new FormConfigurationConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            FormConfigurationInterface::class,
            $this->subject->getObject()
        );
    }

    public function testGetHydratorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getHydratorProperties());
        }
    }

    public function testGetExtractorPropertiesCanReturnArray()
    {
        foreach ($this->arrayKeys as $arrayKey) {
            self::assertArrayHasKey($arrayKey, $this->subject->getExtractorProperties());
        }
    }
}
