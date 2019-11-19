<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingDetail;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class MailingDetailConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingDetailConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MailingDetail();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'name' => StringValue::set('name'),
            'customer_id' => IntegerValue::set('mandatorId'),
            'category_id' => IntegerValue::set('folderId'),
            'type_id' => IntegerValue::set('typeId'),
            'url' => StringValue::set('url'),
            'send_start_time' => IntegerValue::set('sendStartTime'),
            'send_end_time' => IntegerValue::set('sendEndTime'),
            'timestamp' => IntegerValue::set('timestamp'),
            'recipients' => IntegerValue::set('recipients'),
            'sent' => IntegerValue::set('sent'),
            'preview_url' => StringValue::set('previewUrl'),
            'report_url' => StringValue::set('reportUrl'),
            'admin_url' => StringValue::set('adminUrl'),
            'subject' => StringValue::set('subject'),
            'targetgroup_id' => IntegerValue::set('targetGroupId'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'name' => StringValue::get('name'),
            'customer_id' => IntegerValue::get('mandatorId'),
            'category_id' => IntegerValue::get('folderId'),
            'type_id' => IntegerValue::get('typeId'),
            'url' => StringValue::get('url'),
            'send_start_time' => IntegerValue::get('sendStartTime'),
            'send_end_time' => IntegerValue::get('sendEndTime'),
            'timestamp' => IntegerValue::get('timestamp'),
            'recipients' => IntegerValue::get('recipients'),
            'sent' => IntegerValue::get('sent'),
            'preview_url' => StringValue::get('previewUrl'),
            'report_url' => StringValue::get('reportUrl'),
            'admin_url' => StringValue::get('adminUrl'),
            'subject' => StringValue::get('subject'),
            'targetgroup_id' => IntegerValue::get('targetGroupId'),
        ];
    }
}
