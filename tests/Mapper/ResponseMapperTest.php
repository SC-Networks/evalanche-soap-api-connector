<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Mapper;

use PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations;
use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Exception\EmptyResultException;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\User\UserInterface;
use Scn\Hydrator\HydratorInterface;
use stdClass;

#[AllowMockObjectsWithoutExpectations]
class ResponseMapperTest extends TestCase
{
    private ResponseMapper $subject;

    /**
     * @var MockObject&HydratorInterface
     */
    private MockObject $hydrator;

    public function setUp(): void
    {
        $this->hydrator = $this->createMock(HydratorInterface::class);
        $this->subject = new ResponseMapper(
            $this->hydrator
        );
    }

    public function testGetIntegerCanReturnInteger(): void
    {
        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = 5;

        self::assertSame(5, $this->subject->getInteger($response, $responseProperty));
    }

    public function testGetIntegerCanThrowException(): void
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getInteger(new stdClass(), 'something');
    }

    public function testGetBooleanCanReturnBool(): void
    {
        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = true;

        $this->assertTrue($this->subject->getBoolean($response, $responseProperty));
    }

    public function testGetBooleanCanThrowException(): void
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getBoolean(new stdClass(), 'something');
    }

    public function testGetStringCanReturnString(): void
    {
        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = 'some string';

        self::assertSame('some string', $this->subject->getString($response, $responseProperty));
    }

    public function testGetStringCanThrowException(): void
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getString(new stdClass(), 'something');
    }

    public function testGetArrayCanReturnArray(): void
    {
        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = [
            'soem' => 'array',
            'key' => 'value',
        ];

        self::assertSame($response->$responseProperty, $this->subject->getArray($response, $responseProperty));
    }

    public function testGetArrayCanThrowException(): void
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getArray(new stdClass(), 'something');
    }

    public function testGetObjectCanReturnObject(): void
    {
        $responseObject = new stdClass();
        $responseObject->id = 1;
        $responseObject->demo = 55;

        $responseProperty = 'someThing';
        $response = new stdClass();
        $response->$responseProperty = $responseObject;

        $someUser = $this->createStub(UserInterface::class);

        $hydratorConfig = $this->createMock(HydratorConfigInterface::class);
        $hydratorConfig->expects($this->once())->method('getObject')
            ->willReturn($someUser);

        $this->hydrator->expects($this->once())->method('hydrate')
            ->with($hydratorConfig, $someUser, (array) $responseObject);

        self::assertInstanceOf(
            UserInterface::class,
            $this->subject->getObject(
                $response,
                $responseProperty,
                $hydratorConfig
            )
        );
    }

    public function testGetObjectCanThrowException(): void
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getObject(
            new stdClass(),
            'something',
            $this->createStub(HydratorConfigInterface::class)
        );
    }

    public function testGetObjectsCanReturnObjects(): void
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

        $someUser = $this->createStub(UserInterface::class);

        $hydratorConfig = $this->createMock(HydratorConfigInterface::class);
        $hydratorConfig->expects($this->exactly(2))->method('getObject')
            ->willReturn($someUser);

        $this->hydrator->expects($this->exactly(2))->method('hydrate')
            ->willReturnOnConsecutiveCalls(
                [$hydratorConfig, $someUser, (array) $firstResponseObject],
                [$hydratorConfig, $someUser, (array) $secondResponseObject]
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

    public function testGetObjectsCanReturnEmptyArray(): void
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

        $hydratorConfig = $this->createStub(HydratorConfigInterface::class);

        self::assertEquals(
            [],
            $this->subject->getObjects(
                $response,
                $responseProperty,
                $hydratorConfig
            )
        );
    }

    public function testGetObjectsCanReturnSingleObject(): void
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

        $someUser = $this->createStub(UserInterface::class);

        $hydratorConfig = $this->createMock(HydratorConfigInterface::class);
        $hydratorConfig->expects($this->once())->method('getObject')
            ->willReturn($someUser);

        $this->hydrator->expects($this->once())->method('hydrate')
            ->with($hydratorConfig, $someUser, (array) $firstResponseObject);

        self::assertContainsOnlyInstancesOf(
            UserInterface::class,
            $this->subject->getObjects(
                $response,
                $responseProperty,
                $hydratorConfig
            )
        );
    }

    public function testGetObjectsCanThrowException(): void
    {
        $this->expectException(EmptyResultException::class);
        $this->subject->getObjects(
            new stdClass(),
            'something',
            $this->createStub(HydratorConfigInterface::class)
        );
    }

    public function testGetObjectDirectlyCanReturnObject(): void
    {
        $responseObject = new stdClass();
        $responseObject->id = 1;
        $responseObject->demo = 55;

        $response = $responseObject;

        $someUser = $this->createStub(UserInterface::class);

        $hydratorConfig = $this->createMock(HydratorConfigInterface::class);
        $hydratorConfig->expects($this->once())->method('getObject')
            ->willReturn($someUser);

        $this->hydrator->expects($this->once())->method('hydrate')
            ->with($hydratorConfig, $someUser, (array) $responseObject);

        self::assertInstanceOf(
            UserInterface::class,
            $this->subject->getObjectDirectly(
                $response,
                $hydratorConfig
            )
        );
    }

    public function testGetObjectsDirectyCanReturnArrayOfObjects(): void
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

        $someUser = $this->createStub(UserInterface::class);

        $hydratorConfig = $this->createMock(HydratorConfigInterface::class);
        $hydratorConfig->expects($this->exactly(2))->method('getObject')
            ->willReturn($someUser);

        $this->hydrator->expects($this->exactly(2))->method('hydrate')
            ->willReturnOnConsecutiveCalls(
                [$hydratorConfig, $someUser, (array) $firstResponseObject],
                [$hydratorConfig, $someUser, (array) $secondResponseObject]
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
