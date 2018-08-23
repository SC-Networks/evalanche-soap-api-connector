<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\MailClientStatisticItemConfig;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\MailClientStatisticItemInterface;

/**
 * Class ArrayOfObjectValueTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
class ArrayOfObjectValueTest extends TestCase
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

        $set = ArrayOfObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ArrayOfObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertInternalType('array', $dummy->getValue());
        static::assertSame($testValue->item, $dummy->getValue());
        static::assertSame($testValue->item, $get('value'));
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

        $set = ArrayOfObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ArrayOfObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertInternalType('array', $dummy->getValue());
        static::assertSame([$testValue->item], $dummy->getValue());
        static::assertSame([$testValue->item], $get('value'));
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

        $set = ArrayOfObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ArrayOfObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertInternalType('array', $dummy->getValue());
        static::assertSame([], $dummy->getValue());
        static::assertSame([], $get('value'));
    }

    public function testContainsHydratedObjects()
    {
        $firstObject = new \stdClass();
        $firstObject->description = 'some thing';
        $firstObject->count = 456;

        $secondObject = new \stdClass();
        $secondObject->description = 'some thing other';
        $secondObject->count = 4561;

        $testValue = new \stdClass();
        $testValue->item = [$firstObject, $secondObject];

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

        $set = ArrayOfObjectValue::set('value', new MailClientStatisticItemConfig());
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ArrayOfObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertInternalType('array', $dummy->getValue());
        static::assertContainsOnlyInstancesOf(MailClientStatisticItemInterface::class, $dummy->getValue());
    }

    public function testContainsHydratedObjectsIfValueIsArray()
    {
        $firstObject = new \stdClass();
        $firstObject->description = 'some thing';
        $firstObject->count = 456;

        $secondObject = new \stdClass();
        $secondObject->description = 'some thing other';
        $secondObject->count = 4561;

        $testValue = [$firstObject, $secondObject];

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

        $set = ArrayOfObjectValue::set('value', new MailClientStatisticItemConfig());
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ArrayOfObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertInternalType('array', $dummy->getValue());
        static::assertContainsOnlyInstancesOf(MailClientStatisticItemInterface::class, $dummy->getValue());
    }
}
