<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Config\User;

use Scn\EvalancheSoapApiConnector\Hydrator\Property\ArrayValue;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapStruct\Struct\StructInterface;
use Scn\EvalancheSoapStruct\Struct\User\User;
use Scn\HydratorPropertyValues\Property\BooleanValue;
use Scn\HydratorPropertyValues\Property\IntegerValue;
use Scn\HydratorPropertyValues\Property\StringValue;

/**
 * Class UserConfig
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\User
 */
class UserConfig implements HydratorConfigInterface
{
    public function getObject(): StructInterface
    {
        return new User();
    }

    public function getHydratorProperties(): array
    {
        return [
            'id' => IntegerValue::set('id'),
            'mandator_id' => IntegerValue::set('mandatorId'),
            'username' => StringValue::set('username'),
            'email' => StringValue::set('email'),
            'salutation' => IntegerValue::set('salutation'),
            'firstname' => StringValue::set('firstName'),
            'name' => StringValue::set('name'),
            'description' => StringValue::set('description'),
            'security_guideline_id' => IntegerValue::set('securityGuidelineId'),
            'role_ids' => ArrayValue::set('roleIds'),
            'disabled' => BooleanValue::set('disabled'),
            'password' => StringValue::set('password'),
        ];
    }

    public function getExtractorProperties(): array
    {
        return [
            'id' => IntegerValue::get('id'),
            'mandator_id' => IntegerValue::get('mandatorId'),
            'username' => StringValue::get('username'),
            'email' => StringValue::get('email'),
            'salutation' => IntegerValue::get('salutation'),
            'firstname' => StringValue::get('firstName'),
            'name' => StringValue::get('name'),
            'description' => StringValue::get('description'),
            'security_guideline_id' => IntegerValue::get('securityGuidelineId'),
            'role_ids' => ArrayValue::get('roleIds'),
            'disabled' => BooleanValue::get('disabled'),
            'password' => StringValue::get('password'),
        ];
    }
}
