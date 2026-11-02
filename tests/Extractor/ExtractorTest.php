<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Extractor;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\User\UserInterface;
use Scn\Hydrator\HydratorInterface;

/**
 * Class ExtractorTest
 *
 * @package Scn\EvalancheSoapApiConnector\Extractor
 */
class ExtractorTest extends TestCase
{
    private Extractor $subject;

    /**
     * @var MockObject&HydratorInterface
     */
    private MockObject $hydrator;

    public function setUp(): void
    {
        $this->hydrator = $this->createMock(HydratorInterface::class);
        $this->subject = new Extractor(
            $this->hydrator
        );
    }

    public function testExtractCanReturnArray(): void
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $user = $this->createStub(UserInterface::class);

        $this->hydrator->expects($this->once())->method('extract')
            ->with($config, $user)
            ->willReturn([
                'id' => 5,
                'password' => 'something',
                'somethingempty' => '',
                'somethingnull' => null,
                'somethingfalse' => false,
            ]);

        self::assertSame([
            'id' => 5,
            'password' => 'something',
            'somethingempty' => '',
        ], $this->subject->extract(
            $config,
            $user
        ));
    }

    public function testExtractArrayCanReturnArray(): void
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $user = $this->createStub(UserInterface::class);

        $this->hydrator->expects($this->exactly(2))->method('extract')
            ->with($config, $user)
            ->willReturn([
                'id' => 5,
                'password' => 'something',
                'somethingempty' => '',
                'somethingnull' => null,
                'somethingfalse' => false,
            ]);

        $expectedArray = [
            [
                'id' => 5,
                'password' => 'something',
                'somethingempty' => '',
            ],
            [
                'id' => 5,
                'password' => 'something',
                'somethingempty' => '',
            ]
        ];

        self::assertSame($expectedArray, $this->subject->extractArray(
            $config,
            [$user, $user]
        ));
    }
}
