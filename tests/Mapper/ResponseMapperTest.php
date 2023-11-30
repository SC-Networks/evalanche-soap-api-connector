<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Mapper;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\User\UserInterface;
use Scn\Hydrator\HydratorInterface;
use stdClass;

class ResponseMapperTest extends TestCase
{
    /**
     * @var ResponseMapper
     */
    private $subject;

    /**
     * @var HydratorInterface|MockObject
     */
    private $hydrator;

    public function setUp(): void
    {
        $this->hydrator = $this->getMockBuilder(HydratorInterface::class)->getMock();
        $this->subject = new ResponseMapper(
            $this->hydrator
        );
    }

    public function testGetIntegerCanReturnInteger()
    {
        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = 5;

        self::assertSame(5, $this->subject->getInteger($response, $responseProperty));
    }

    public function testGetIntegerCanThrowException()
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getInteger(new stdClass(), 'something');
    }

    public function testGetBooleanCanReturnBool()
    {
        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = true;

        $this->assertTrue($this->subject->getBoolean($response, $responseProperty));
    }

    public function testGetBooleanCanThrowException()
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getBoolean(new stdClass(), 'something');
    }

    public function testGetStringCanReturnString()
    {
        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = 'some string';

        self::assertSame('some string', $this->subject->getString($response, $responseProperty));
    }

    public function testGetStringCanThrowException()
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getString(new stdClass(), 'something');
    }

    public function testGetArrayCanReturnArray()
    {
        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = [
            'soem' => 'array',
            'key' => 'value',
        ];

        self::assertSame($response->$responseProperty, $this->subject->getArray($response, $responseProperty));
    }

    public function testGetArrayCanThrowException()
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getArray(new stdClass(), 'something');
    }

    public function testGetObjectCanReturnObject()
    {
        $responseObject = new stdClass();
        $responseObject->id = 1;
        $responseObject->demo = 55;

        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = $responseObject;

        $someUser = $this->getMockBuilder(UserInterface::class)->getMock();

        $hydratorConfig = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $hydratorConfig->expects($this->once())->method('getObject')
            ->willReturn($someUser);

        $this->hydrator->expects($this->once())->method('hydrate')
            ->with($hydratorConfig, $someUser, (array)$responseObject);

        self::assertInstanceOf(
            UserInterface::class,
            $this->subject->getObject(
                $response,
                $responseProperty,
                $hydratorConfig
            )
        );
    }

    public function testGetObjectCanThrowException()
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getObject(
            new stdClass(),
            'something',
            $this->getMockBuilder(HydratorConfigInterface::class)->getMock()
        );
    }

    public function testGetObjectsCanReturnObjects()
    {
        $firstResponseObject = new stdClass();
        $firstResponseObject->id = 1;
        $firstResponseObject->demo = 55;

        $secondResponseObject = new stdClass();
        $secondResponseObject->id = 1;
        $secondResponseObject->demo = 55;

        $collection = new stdClass();
        $collection->item = [
            $firstResponseObject,
            $secondResponseObject
        ];

        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = $collection;

        $someUser = $this->getMockBuilder(UserInterface::class)->getMock();

        $hydratorConfig = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $hydratorConfig->expects($this->exactly(2))->method('getObject')
            ->willReturn($someUser);

        $this->hydrator->expects($this->exactly(2))->method('hydrate')
            ->willReturnOnConsecutiveCalls(
                [$hydratorConfig, $someUser, (array)$firstResponseObject],
                [$hydratorConfig, $someUser, (array)$secondResponseObject]
            );

        self::assertContainsOnlyInstancesOf(
            UserInterface::class,
            $this->subject->getObjects(
                $response,
                $responseProperty,
                $hydratorConfig
            )
        );
    }

    public function testGetObjectsCanReturnEmptyArray()
    {
        $firstResponseObject = new stdClass();
        $firstResponseObject->id = 1;
        $firstResponseObject->demo = 55;

        $secondResponseObject = new stdClass();
        $secondResponseObject->id = 1;
        $secondResponseObject->demo = 55;

        $collection = new stdClass();
        $collection->items = [
            $firstResponseObject,
            $secondResponseObject
        ];

        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = $collection;

        $hydratorConfig = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();

        self::assertEquals(
            [],
            $this->subject->getObjects(
                $response,
                $responseProperty,
                $hydratorConfig
            )
        );
    }

    public function testGetObjectsCanReturnSingleObject()
    {
        $firstResponseObject = new stdClass();
        $firstResponseObject->id = 1;
        $firstResponseObject->demo = 55;

        $secondResponseObject = new stdClass();
        $secondResponseObject->id = 1;
        $secondResponseObject->demo = 55;

        $collection = new stdClass();
        $collection->item = $firstResponseObject;

        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = $collection;

        $someUser = $this->getMockBuilder(UserInterface::class)->getMock();

        $hydratorConfig = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $hydratorConfig->expects($this->once())->method('getObject')
            ->willReturn($someUser);

        $this->hydrator->expects($this->once())->method('hydrate')
            ->with($hydratorConfig, $someUser, (array)$firstResponseObject);

        self::assertContainsOnlyInstancesOf(
            UserInterface::class,
            $this->subject->getObjects(
                $response,
                $responseProperty,
                $hydratorConfig
            )
        );
    }

    public function testGetObjectsCanThrowException()
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getObjects(
            new stdClass(),
            'something',
            $this->getMockBuilder(HydratorConfigInterface::class)->getMock()
        );
    }

    public function testGetObjectDirectlyCanReturnObject()
    {
        $responseObject = new stdClass();
        $responseObject->id = 1;
        $responseObject->demo = 55;

        $response = $responseObject;

        $someUser = $this->getMockBuilder(UserInterface::class)->getMock();

        $hydratorConfig = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $hydratorConfig->expects($this->once())->method('getObject')
            ->willReturn($someUser);

        $this->hydrator->expects($this->once())->method('hydrate')
            ->with($hydratorConfig, $someUser, (array)$responseObject);

        self::assertInstanceOf(
            UserInterface::class,
            $this->subject->getObjectDirectly(
                $response,
                $hydratorConfig
            )
        );
    }

    public function testGetObjectsDirectyCanReturnArrayOfObjects()
    {
        $firstResponseObject = new stdClass();
        $firstResponseObject->id = 1;
        $firstResponseObject->demo = 55;

        $secondResponseObject = new stdClass();
        $secondResponseObject->id = 1;
        $secondResponseObject->demo = 55;

        $response = new stdClass();
        $response->item = [
            $firstResponseObject,
            $secondResponseObject
        ];

        $someUser = $this->getMockBuilder(UserInterface::class)->getMock();

        $hydratorConfig = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $hydratorConfig->expects($this->exactly(2))->method('getObject')
            ->willReturn($someUser);

        $this->hydrator->expects($this->exactly(2))->method('hydrate')
            ->willReturnOnConsecutiveCalls(
                [$hydratorConfig, $someUser, (array)$firstResponseObject],
                [$hydratorConfig, $someUser, (array)$secondResponseObject]
            );

        self::assertContainsOnlyInstancesOf(
            UserInterface::class,
            $this->subject->getObjectsDirectly(
                $response,
                $hydratorConfig
            )
        );
    }
}
