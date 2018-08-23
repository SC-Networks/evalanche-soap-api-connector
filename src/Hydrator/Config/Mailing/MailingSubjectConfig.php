<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\Mailing;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\Mailing\MailingSubject;
use Scn\EvalancheSoapStruct\Struct\StructInterface;

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
            'targetgroup_id' => Property\IntegerValue::set('targetGroupId'),
            'subjectline' => Property\TextValue::set('subject'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'targetgroup_id' => Property\IntegerValue::get('targetGroupId'),
            'subjectline' => Property\TextValue::get('subject'),
        ];
    }
}