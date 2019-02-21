<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Scn\EvalancheSoapApiConnector\TestCase;

/**
 * Class ArrayValueTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
class ArrayValueTest extends TestCase
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

        $set = ArrayValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ArrayValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertIsArray($dummy->getValue());
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

        $set = ArrayValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ArrayValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertIsArray($dummy->getValue());
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

        $set = ArrayValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ArrayValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertIsArray($dummy->getValue());
        static::assertSame([], $dummy->getValue());
        static::assertSame([], $get('value'));
    }
}
