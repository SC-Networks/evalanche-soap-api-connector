<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Scn\EvalancheSoapApiConnector\TestCase;

/**
 * Class IntegerValueTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
class IntegerValueTest extends TestCase
{
    public function testEverything()
    {
        $testValue = mt_rand(1, PHP_INT_MAX);
        $dummy = new class {
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

        $set = IntegerValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = IntegerValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertIsInt($dummy->getValue());
        static::assertSame($testValue, $dummy->getValue());
        static::assertSame($testValue, $get('value'));
    }

    public function testEverythingInvalidInputType()
    {
        $testValue = substr(str_shuffle(str_repeat(
            $x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            ceil(10 / strlen($x))
        )), 1, 10);
        $dummy = new class {
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

        $set = IntegerValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = IntegerValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertIsInt($dummy->getValue());
        static::assertSame(0, $dummy->getValue());
        static::assertSame(0, $get('value'));
    }
}
