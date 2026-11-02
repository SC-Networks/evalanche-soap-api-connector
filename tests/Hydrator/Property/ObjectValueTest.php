<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Hydrator\Property;

use Closure;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\Statistic\MailClientStatisticItemConfig;
use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Statistic\MailClientStatisticItemInterface;
use stdClass;

/**
 * Class ObjectValueTest
 *
 * @package Scn\EvalancheSoapApiConnector\Hydrator\Property
 */
class ObjectValueTest extends TestCase
{
    public function testEverything(): void
    {
        $testValue = new stdClass();
        $testValue->item = [
            'some thing' => 'fine'
        ];

        $dummy = new class {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value): void
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $get);
        self::assertNull($dummy->getValue());
        self::assertNull($get('value'));
    }

    public function testContainsHydratedObjects(): void
    {
        $testValue = new stdClass();
        $testValue->description = 'some thing';
        $testValue->count = 456;

        $dummy = new class {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value): void
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value', new MailClientStatisticItemConfig());
        $set = $set->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $get);
        self::assertInstanceOf(MailClientStatisticItemInterface::class, $dummy->getValue());
    }

    public function testEverythingIfItemNotArray(): void
    {
        $testValue = new stdClass();
        $testValue->item = 'fine';

        $dummy = new class {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value): void
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $get);
        self::assertNull($dummy->getValue());
        self::assertNull($get('value'));
    }


    public function testEverythingInvalidInputType(): void
    {
        $testValue = mt_rand(1, PHP_INT_MAX);
        $dummy = new class {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value): void
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value');
        $set = $set->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $get);
        self::assertNull($dummy->getValue());
        self::assertNull($get('value'));
    }

    public function testContainsHydratedObjectsIfValueIsArray(): void
    {
        $testValue = new stdClass();
        $testValue->description = 'some thing';
        $testValue->count = 456;

        $dummy = new class {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value): void
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value', new MailClientStatisticItemConfig());
        $set = $set->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value');
        $get = $get->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $get);
        self::assertInstanceOf(MailClientStatisticItemInterface::class, $dummy->getValue());
    }

    public function testGetWithHydratorContainsHydratedObjectsIfValueIsArray(): void
    {
        $testValue = new stdClass();
        $testValue->description = 'some thing';
        $testValue->count = 456;

        $dummy = new class {
            private $value;

            public function getValue()
            {
                return $this->value;
            }

            public function setValue($value): void
            {
                $this->value = $value;
            }
        };

        $set = ObjectValue::set('value', new MailClientStatisticItemConfig());
        $set = $set->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $set);

        $set($testValue, 'value', $dummy);

        $get = ObjectValue::get('value', new MailClientStatisticItemConfig());
        $get = $get->bindTo($dummy, $dummy);
        self::assertInstanceOf(Closure::class, $get);
        self::assertInstanceOf(MailClientStatisticItemInterface::class, $dummy->getValue());
    }
}
