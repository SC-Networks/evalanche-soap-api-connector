<?php

namespace Scn\EvalancheSoapApiConnector\Extractor;

use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\TestCase;
use Scn\EvalancheSoapStruct\Struct\User\UserInterface;
use Scn\Hydrator\HydratorInterface;

/**
 * Class ExtractorTest
 *
 * @package Scn\EvalancheSoapApiConnector\Extractor
 */
class ExtractorTest extends TestCase
{
    /**
     * @var Extractor
     */
    private $subject;

    /**
     * @var HydratorInterface|MockObject
     */
    private $hydrator;

    public function setUp()
    {
        $this->hydrator = $this->getMockBuilder(HydratorInterface::class)->getMock();
        $this->subject = new Extractor(
            $this->hydrator
        );
    }

    public function testExtractCanReturnArray()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $user = $this->getMockBuilder(UserInterface::class)->getMock();

        $this->hydrator->expects($this->once())->method('extract')
            ->with($config, $user)
            ->willReturn([
                'id' => 5,
                'password' => 'something',
                'somethingempty' => ''
            ]);

        $this->assertSame([
            'id' => 5,
            'password' => 'something'
        ], $this->subject->extract(
            $config,
            $user
        ));
    }

    public function testExtractArrayCanReturnArray()
    {
        $config = $this->getMockBuilder(HydratorConfigInterface::class)->getMock();
        $user = $this->getMockBuilder(UserInterface::class)->getMock();

        $this->hydrator->expects($this->exactly(2))->method('extract')
            ->with($config, $user)
            ->willReturn([
                'id' => 5,
                'password' => 'something',
                'somethingempty' => ''
            ]);

        $expectedArray = [
            [
                'id' => 5,
                'password' => 'something'
            ],
            [
                'id' => 5,
                'password' => 'something'
            ]
        ];

        $this->assertSame($expectedArray, $this->subject->extractArray(
            $config,
            [$user, $user]
        ));
    }
}
