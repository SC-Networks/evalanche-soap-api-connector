<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\MailClientStatisticItemConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\MailClientStatisticItemInterface;

/**
 * Class ObjectValueTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
class ObjectValueTest extends TestCase
{

    public function testEverything()
    {
        $testValue = new \stdClass();
        $testValue->item = [
            'some thing' => 'fine'
        ];

        $dummy = new class
        {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value)
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertNull($dummy->getValue());
        static::assertNull($get('value'));
    }

    public function testContainsHydratedObjects()
    {
        $testValue = new \stdClass();
        $testValue->description = 'some thing';
        $testValue->count = 456;

        $dummy = new class
        {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value)
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value', new MailClientStatisticItemConfig());
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertInstanceOf(MailClientStatisticItemInterface::class, $dummy->getValue());
    }

    public function testEverythingIfItemNotArray()
    {
        $testValue = new \stdClass();
        $testValue->item = 'fine';

        $dummy = new class
        {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value)
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertNull($dummy->getValue());
        static::assertNull($get('value'));
    }


    public function testEverythingInvalidInputType()
    {
        $testValue = mt_rand(1, PHP_INT_MAX);
        $dummy = new class
        {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value)
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertNull($dummy->getValue());
        static::assertNull($get('value'));
    }

    public function testContainsHydratedObjectsIfValueIsArray()
    {
        $testValue = new \stdClass();
        $testValue->description = 'some thing';
        $testValue->count = 456;

        $dummy = new class
        {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value)
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value', new MailClientStatisticItemConfig());
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertInstanceOf(MailClientStatisticItemInterface::class, $dummy->getValue());
    }
}
