<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\User;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Property;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\EvalancheSoapStruct\Struct\User\User;

/**
 * Class UserConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\User
 */
class UserConfig implements HydratorConfigInterface
{

    /**
     * @return StructInterface
     */
    public function getObject(): StructInterface
    {
        return new User();
    }

    /**
     * @return array
     */
    public function getHydratorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::set('id'),
            'mandator_id' => Property\IntegerValue::set('mandatorId'),
            'username' => Property\TextValue::set('username'),
            'email' => Property\TextValue::set('email'),
            'salutation' => Property\IntegerValue::set('salutation'),
            'firstname' => Property\TextValue::set('firstName'),
            'name' => Property\TextValue::set('name'),
            'description' => Property\TextValue::set('description'),
            'security_guideline_id' => Property\IntegerValue::set('securityGuidelineId'),
            'role_ids' => Property\ArrayValue::set('roleIds'),
            'disabled' => Property\BooleanValue::set('disabled'),
            'password' => Property\TextValue::set('password'),
        ];
    }

    /**
     * @return array
     */
    public function getExtractorProperties(): array
    {
        return [
            'id' => Property\IntegerValue::get('id'),
            'mandator_id' => Property\IntegerValue::get('mandatorId'),
            'username' => Property\TextValue::get('username'),
            'email' => Property\TextValue::get('email'),
            'salutation' => Property\IntegerValue::get('salutation'),
            'firstname' => Property\TextValue::get('firstName'),
            'name' => Property\TextValue::get('name'),
            'description' => Property\TextValue::get('description'),
            'security_guideline_id' => Property\IntegerValue::get('securityGuidelineId'),
            'role_ids' => Property\ArrayValue::get('roleIds'),
            'disabled' => Property\BooleanValue::get('disabled'),
            'password' => Property\TextValue::get('password'),
        ];
    }
}