<?php

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Scn\EvalancheSoapApiConnector\TestCase;

/**
 * Class FloatValueTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
class FloatValueTest extends TestCase
{

    public function testEverything()
    {
        $testValue = round(mt_rand(1, PHP_INT_MAX), 2);
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

        $set = FloatValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = FloatValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertInternalType('float', $dummy->getValue());
        static::assertSame($testValue, $dummy->getValue());
        static::assertSame($testValue, $get('value'));
    }

    public function testEverythingInvalidInputType()
    {
        $testValue = substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            ceil(10 / strlen($x)))), 1, 10);
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

        $set = FloatValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = FloatValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        static::assertInstanceOf(\Closure::class, $get);
        static::assertInternalType('float', $dummy->getValue());
        static::assertSame(0.0, $dummy->getValue());
        static::assertSame(0.0, $get('value'));
    }
}
