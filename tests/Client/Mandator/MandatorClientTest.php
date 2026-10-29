<?php

declare(strict_types=1);

namespace Scn\EvalancheSoapApiConnector\Client\Mandator;

use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\MockObject\MockObject;
use Scn\EvalancheSoapApiConnector\EvalancheSoapClient;
use Scn\EvalancheSoapApiConnector\Extractor\ExtractorInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigFactoryInterface;
use Scn\EvalancheSoapApiConnector\Hydrator\Config\HydratorConfigInterface;
use Scn\EvalancheSoapApiConnector\Mapper\ResponseMapperInterface;
use PHPUnit\Framework\TestCase;
use Scn\EvalancheSoapStruct\Struct\Mandator\MandatorInterface;
use stdClass;

class MandatorClientTest extends TestCase
{
    /**
     * @var MandatorClient
     */
    private $subject;

    /**
     * @var EvalancheSoapClient|MockObject
     */
    private $soapClient;

    /**
     * @var ResponseMapperInterface|MockObject
     */
    private $responseMapper;

    /**
     * @var HydratorConfigFactoryInterface|MockObject
     */
    private $hydratorConfigFactory;

    /**
     * @var Stub&ExtractorInterface
     */
    private Stub $extractor;

    public function setUp(): void
    {
        $this->soapClient = $this->createMock(EvalancheSoapClient::class);
        $this->responseMapper = $this->createMock(ResponseMapperInterface::class);
        $this->hydratorConfigFactory = $this->createMock(HydratorConfigFactoryInterface::class);
        $this->extractor = $this->createStub(ExtractorInterface::class);

        $this->subject = new MandatorClient(
            $this->soapClient,
            $this->responseMapper,
            $this->hydratorConfigFactory,
            $this->extractor
        );
    }

    public function testGetByIdCanReturnMandatorInterface()
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MandatorInterface::class);

        $result = new stdClass();
        $result->getByIdResult = $object;

        $this->hydratorConfigFactory->expects($this->once())->method('createMandatorConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'getById',
                [[
                    'mandator_id' => 5
                ]]
            )
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObject')
            ->with($result, 'getByIdResult', $config)
            ->willReturn($object);

        self::assertSame(
            $object,
            $this->subject->getById(5)
        );
    }

    public function testGetListCanReturnArrayOfMandatorInterface()
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MandatorInterface::class);
        $otherObject = $this->createStub(MandatorInterface::class);

        $list = new stdClass();
        $list->item = [
            $object,
            $otherObject
        ];

        $result = new stdClass();
        $result->getListResult = $list;

        $this->hydratorConfigFactory->expects($this->once())->method('createMandatorConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())->method('__call')
            ->with('getList', [])
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObjects')
            ->with($result, 'getListResult', $config)
            ->willReturn([$object, $otherObject]);

        $this->assertContainsOnlyInstancesOf(
            MandatorInterface::class,
            $this->subject->getList()
        );
    }

    public function testCreateReturnsMandatorInstance(): void
    {
        $config = $this->createStub(HydratorConfigInterface::class);
        $object = $this->createStub(MandatorInterface::class);

        $result = new stdClass();
        $result->createResult = $object;

        $name = 'some-name';
        $demo_mode = true;
        $pricemodel_id = 123;
        $description = 'some-description';
        $industry_type = 111;

        $this->hydratorConfigFactory->expects($this->once())->method('createMandatorConfig')
            ->willReturn($config);

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'create',
                [[
                    'name' => $name,
                    'demo_mode' => $demo_mode,
                    'pricemodel_id' => $pricemodel_id,
                    'description' => $description,
                    'industry_type' => $industry_type,
                ]]
            )
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getObject')
            ->with($result, 'createResult', $config)
            ->willReturn($object);

        self::assertSame(
            $object,
            $this->subject->create(
                $name,
                $demo_mode,
                $pricemodel_id,
                $description,
                $industry_type
            )
        );
    }

    public function testImportScenarioImports(): void
    {
        $object = $this->createStub(MandatorInterface::class);

        $result = new stdClass();
        $result->importScenarioResult = $object;

        $mandator_id = 666;
        $scenario_content = 'some-data';
        $language_code = 'some-language';

        $this->soapClient->expects($this->once())->method('__call')
            ->with(
                'importScenario',
                [[
                    'mandator_id' => $mandator_id,
                    'scenario_data' => $scenario_content,
                    'language_code' => $language_code,
                ]]
            )
            ->willReturn($result);

        $this->responseMapper
            ->expects($this->once())
            ->method('getBoolean')
            ->with($result, 'importScenarioResult')
            ->willReturn(true);

        self::assertTrue(
            $this->subject->importScenario(
                $mandator_id,
                $scenario_content,
                $language_code,
            )
        );
    }
}
