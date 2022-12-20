<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSubject;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class MailingSubjectConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Mailing
 */
class MailingSubjectConfig implements HydratorConfigInterface
{
    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new MailingSubject();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'targetgroup_id' => IntegerValue::set('targetGroupId'),
            'subjectline' => StringValue::set('subject'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'targetgroup_id' => IntegerValue::get('targetGroupId'),
            'subjectline' => StringValue::get('subject'),
        ];
    }
}
