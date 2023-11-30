<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingConfigurationInterface;

class MailingConfigurationConfigTest extends TestCase
{
    /**
     * @var MailingConfigurationConfig
     */
    private $subject;

    /**
     * @var array
     */
    private $arrayKeys = [
        'external_trackingcode',
        'campaign_id',
        'externalxml_url',
        'salutation_female',
        'salutation_male',
        'salutation_company',
        'salutation_family',
        'salutation_other',
        'salutation_divers',
        'sender_email',
        'sender_name',
        'reply_name',
        'reply_email',
        'grant_url',
        'revoke_url',
        'inputfield_0',
        'inputfield_1',
        'inputfield_2',
        'inputfield_3',
        'inputfield_4',
        'inputfield_5',
        'inputfield_6',
        'inputfield_7',
        'inputfield_8',
        'inputfield_9',
        'textarea_0',
        'textarea_1',
        'textarea_2',
        'textarea_3',
        'textarea_4',
        'textarea_5',
        'textarea_6',
        'textarea_7',
        'textarea_8',
        'textarea_9',
        'htmlarea_0',
        'htmlarea_1',
        'htmlarea_2',
        'htmlarea_3',
        'htmlarea_4',
        'htmlarea_5',
        'htmlarea_6',
        'htmlarea_7',
        'htmlarea_8',
        'htmlarea_9',
    ];

    public function setUp(): void
    {
        $this->subject = new MailingConfigurationConfig();
    }

    public function testGetObjectCanReturnInstanceOfUser()
    {
        self::assertInstanceOf(
            MailingConfigurationInterface::class,
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
