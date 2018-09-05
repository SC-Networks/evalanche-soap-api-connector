<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingDetail;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'id' => Property\IntegerValue::set('id'),
            'name' => Property\TextValue::set('name'),
            'customer_id' => Property\IntegerValue::set('mandatorId'),
            'category_id' => Property\IntegerValue::set('folderId'),
            'type_id' => Property\IntegerValue::set('typeId'),
            'url' => Property\TextValue::set('url'),
            'send_start_time' => Property\IntegerValue::set('sendStartTime'),
            'send_end_time' => Property\IntegerValue::set('sendEndTime'),
            'timestamp' => Property\IntegerValue::set('timestamp'),
            'recipients' => Property\IntegerValue::set('recipients'),
            'sent' => Property\IntegerValue::set('sent'),
            'preview_url' => Property\TextValue::set('previewUrl'),
            'report_url' => Property\TextValue::set('reportUrl'),
            'admin_url' => Property\TextValue::set('adminUrl'),
            'subject' => Property\TextValue::set('subject'),
            'targetgroup_id' => Property\IntegerValue::set('targetGroupId'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'name' => Property\TextValue::get('name'),
            'customer_id' => Property\IntegerValue::get('mandatorId'),
            'category_id' => Property\IntegerValue::get('folderId'),
            'type_id' => Property\IntegerValue::get('typeId'),
            'url' => Property\TextValue::get('url'),
            'send_start_time' => Property\IntegerValue::get('sendStartTime'),
            'send_end_time' => Property\IntegerValue::get('sendEndTime'),
            'timestamp' => Property\IntegerValue::get('timestamp'),
            'recipients' => Property\IntegerValue::get('recipients'),
            'sent' => Property\IntegerValue::get('sent'),
            'preview_url' => Property\TextValue::get('previewUrl'),
            'report_url' => Property\TextValue::get('reportUrl'),
            'admin_url' => Property\TextValue::get('adminUrl'),
            'subject' => Property\TextValue::get('subject'),
            'targetgroup_id' => Property\IntegerValue::get('targetGroupId'),
        ];
    }
}